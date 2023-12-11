
<h1>Top 10 Most Famous Authors</h1>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Author Name</th>
            <th>Vote Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($topAuthors as $key => $author)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $author->name }}</td>
                <td>{{ $author->books_count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
