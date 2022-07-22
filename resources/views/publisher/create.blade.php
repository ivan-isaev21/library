@extends("layouts.app-with-blocks")

@section('breadcrumbs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Library</a></li>
    <li class="breadcrumb-item"><a href="/publishers">Publishers</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="album py-5 bg-light">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-6">
                @yield('breadcrumbs')   
                <form id="publisherForm">
                    <div class="form-group" id="nameWrap">
                        <label for="title">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <div id="validationServerNameFeedback" class="invalid-feedback">
                        </div>
                    </div>                  

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@section('page_scripts')
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script defer>    

    $('#publisherForm').on('submit', e => {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + 'api/v1/external/publishers/',
            data: $('#publisherForm').serialize(),
            success: response => {
                this.clearClientErrors();               
                console.log(response);
                window.location = '/publishers';
            },
            error: response => {
                if (response.responseJSON.errors && response.responseJSON.errors.hasOwnProperty('name')) {
                    $('#name').addClass('is-invalid');
                    $('#validationServerNameFeedback').html(response.responseJSON.errors.name);
                }
            }
        });

    });   

    function clearClientErrors() {
        $('.is-invalid').each(function(index, e) {
            $(this).removeClass('is-invalid');
        });
    }
</script>

@endsection