

<div class="card" style="display:flex; justify-content:center; text-align:center;">
            <div class="card-header">
                <h2>Scan Me</h2>
            </div>
            <div class="card-body">
            {!! QrCode::size(300)->generate(config('app.forntend_url')."/".$event->slug) !!}
            </div>
        </div>