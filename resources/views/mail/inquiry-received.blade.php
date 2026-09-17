<h1>Új PZ Digital megkeresés</h1>
<p><strong>Név:</strong> {{ $inquiry->name }}</p>
<p><strong>E-mail:</strong> {{ $inquiry->email }}</p>
@if($inquiry->company)<p><strong>Cég:</strong> {{ $inquiry->company }}</p>@endif
@if($inquiry->phone)<p><strong>Telefon:</strong> {{ $inquiry->phone }}</p>@endif
<p><strong>Érdeklődés:</strong> {{ $inquiry->interest_type }}</p>
@if($inquiry->product_slug)<p><strong>Termék:</strong> {{ $inquiry->product_slug }}</p>@endif
@if($inquiry->project_slug)<p><strong>Referencia:</strong> {{ $inquiry->project_slug }}</p>@endif
@if($inquiry->message)<p><strong>Üzenet:</strong><br>{{ $inquiry->message }}</p>@endif
<p><strong>Belső azonosító:</strong> {{ $inquiry->id }}</p>
