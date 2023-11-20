@extends("layouts.backend.app")

@section("content")
    @push("scripts")
    <script src="/assets/vendor/ckeditor5/build/ckeditor.js"></script>
    @endpush
    <x-inform-headline title="Artikeleditor" />

    <x-inform-panel>
        <form class="inform-form" action="{{ route("newsfeed::article.store",$article) }}" method="POST">
            @csrf
            <div></div>

            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" name="title" id="title" value="{{ old("title",$article->data['title'] )}}">
            </div>

            <div class="form-group">
                <label for="title">Beitrag</label>
                <textarea name="content" id="editor"></textarea>
            </div>
            @livewire("newsfeed::article-editor",['article' => $article])

            <button type="submit">{{ __("form.save_changes") }}</button>
        </form>
        <script>

            function UpdateTimer(editor) {
                setTimeout(() => {
                    Livewire.dispatch('new-form-data',{content: editor.getData()});
                    UpdateTimer(editor);
                }, 10000 );
            }

            ClassicEditor
                .create( 
                    document.querySelector( '#editor' )
                )
                .then( editor => {
                    editor.setData('{!! $article->data['content'] !!}')
                    UpdateTimer(editor)
                })
                .catch( error => {
                    console.error( error );
                } );
                
                
        </script>
    </x-inform-panel>


@endsection