@extends("layouts.app-with-blocks")

@section('content')
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form>
                    <div class="form-group" id="titleWrap">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title">
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
        loadBook("{{$book->id}}");
        //loadAuthors();
    });

    function loadBook(id) {
        $.ajax({
            type: "GET",
            url: base_url + 'api/v1/external/books/' + id,
            success: response => {
                this.setBook(response.data);
                this.loadAuthors(response.data);
                this.loadPublishers(response.data);
            }
        });
    }

    function loadAuthors(book) {
        $.ajax({
            type: "GET",
            url: base_url + 'api/v1/external/authors/',
            success: response => {
                this.setAuthors(response.data, book);
            }
        });
    }

    function loadPublishers(book) {
        $.ajax({
            type: "GET",
            url: base_url + 'api/v1/external/publishers/',
            success: response => {
                this.setPublishers(response.data, book);
            }
        });
    }

    function setBook(book) {
        $('#title').val(book.title);
    }

    function setAuthors(authors, book) {

        let html = '<label for="authors">Authors</label>';
        html += '<select class="form-control" id="authors" name="authors" multiple>';

        for (author of authors) {
            let selected = null;

            for (bookAuthor of book.authors) {
                selected = null
                
                if (bookAuthor.id == author.id) {                   
                    selected = 'selected';
                    break;
                }
            }

            html += `<option value="${author.id}" ${selected} >${author.first_name} ${author.last_name}</option>`;
        }
        html += '</select>';
        $('#authorsWrap').html(html);
    }

    function setPublishers(publishers, book) {
                
        let html = '<label for="publishers">Publishers</label>';
        html += '<select class="form-control" id="publishers" name="publishers" multiple>';

        for (publisher of publishers) {
            let selected = null;

            for (bookPublisher of book.publishers) {
                selected = null
                
                if (bookPublisher.id == publisher.id) {
                    selected = 'selected';
                    break;
                }
            }
            
            html += `<option value="${publisher.id}" ${selected} >${publisher.name}</option>`;
        }
        html += '</select>';
        $('#publishersWrap').html(html);
    }
</script>

@endsection