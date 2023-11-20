<div>
    {{ $articles->links() }}
    <table class="backend-table">
        <thead>
            <tr>
                <th>Titel</th>
                <th>Ersteller</th>
                <th>{{ __("form.created-at") }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr onclick="window.location.href='{{ route("newsfeed::article.editor",$article->id) }}'">
                    <td>{{ $article->data['title'] }}</td>
                    <td></td>
                    <td>{{ $article->created_at->format("d.m.Y") }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>