
@if(!empty($errors))
    @if(count($errors->all())>0)
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $message)
                            <li>{{ $message}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
@endif