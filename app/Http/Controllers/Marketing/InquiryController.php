<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInquiryRequest;
use App\Jobs\SendInquiryNotification;
use App\Models\Inquiry;
use App\Support\MarketingCatalog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InquiryController extends Controller
{
    public function __construct(private readonly MarketingCatalog $catalog) {}

    public function create(): View
    {
        $interest = request()->string('erdeklodes')->toString();
        $project = request()->string('referencia')->toString();
        $products = $this->catalog->products();
        $projects = $this->catalog->projects();
        $inquiryInterests = $this->catalog->inquiryInterests();
        $allowed = [...$products->keys()->all(), ...$inquiryInterests->keys()->all()];
        $selectedProject = $projects->has($project) ? $project : '';

        return view('pages.contact', [
            'selectedInterest' => $selectedProject !== ''
                ? 'project_reference'
                : (in_array($interest, $allowed, true) ? $interest : ''),
            'selectedProduct' => $products->has($interest) ? $interest : '',
            'selectedProject' => $selectedProject,
            'products' => $products,
            'projects' => $projects,
            'inquiryInterests' => $inquiryInterests,
            'submissionToken' => (string) Str::uuid(),
        ]);
    }

    public function store(StoreInquiryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $inquiry = DB::transaction(function () use ($data): Inquiry {
            $inquiry = Inquiry::firstOrCreate(
                ['submission_token' => $data['submission_token']],
                [
                    ...Arr::only($data, [
                        'name', 'email', 'company', 'phone', 'interest_type', 'product_slug', 'project_slug',
                        'message', 'source_path', 'utm_source', 'utm_medium', 'utm_campaign',
                    ]),
                    'privacy_version' => config('pzdigital.privacy_version'),
                    'process_version' => 'v1',
                    'status' => 'new',
                    'notification_status' => 'pending',
                ],
            );

            if ($inquiry->wasRecentlyCreated) {
                SendInquiryNotification::dispatch($inquiry)->afterCommit();
            }

            return $inquiry;
        });

        return redirect()->route('thank-you')->with('inquiry_reference', $inquiry->id);
    }
}
