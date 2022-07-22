@extends("layouts.app-with-blocks")

@section('breadcrumbs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Library</a></li>
    <li class="breadcrumb-item">Book</li>
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
                <form id="bookForm">
                    <div class="form-group" id="titleWrap">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                        <div id="validationServerTitleFeedback" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="form-group" id="authorsWrap">
                    </div>

                    <div class="form-group" id="publishersWrap">
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
    $(document).ready(function() {
        loadBookForm();
    });

    function loadBookForm() {
        this.loadAuthors();
        this.loadPublishers();
    }

    function loadAuthors() {
        $.ajax({
            type: "GET",
            url: base_url + 'api/v1/external/authors/',
            success: response => {
                this.setAuthors(response.data);
            }
        });
    }

    function loadPublishers() {
        $.ajax({
            type: "GET",
            url: base_url + 'api/v1/external/publishers/',
            success: response => {
                this.setPublishers(response.data);
            }
        });
    }   

    function setAuthors(authors) {
        let html = '<label for="authors">Authors</label>';
        html += '<select class="form-control" id="authors" name="authors[]" multiple>';

        for (author of authors) {                     
            html += `<option value="${author.id}" >${author.first_name} ${author.last_name}</option>`;
        }
        html += '</select>';
        $('#authorsWrap').html(html);
    }

    function setPublishers(publishers) {
        let html = '<label for="publishers">Publishers</label>';
        html += '<select class="form-control" id="publishers" name="publishers[]" multiple>';

        for (publisher of publishers) {          
            html += `<option value="${publisher.id}" >${publisher.name}</option>`;
        }
        html += '</select>';
        $('#publishersWrap').html(html);
    }

    $('#bookForm').on('submit', e => {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + 'api/v1/external/books/',
            data: $('#bookForm').serialize(),
            success: response => {
                this.clearClientErrors();               
                console.log(response);
                window.location = '/';
            },
            error: response => {
                if (response.responseJSON.errors && response.responseJSON.errors.hasOwnProperty('title')) {
                    $('#title').addClass('is-invalid');
                    $('#validationServerTitleFeedback').html(response.responseJSON.errors.title);
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