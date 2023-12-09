<a href="{{ route('authors.top') }}">Top Authors</a>
<a href="{{ route('ratings.create') }}">Rate a Book</a>
<form action="{{ route('books.index') }}" method="GET">
    <label for="perPage">Show:</label>
    <select name="perPage" id="perPage">
        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
        <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
        <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
    </select>

    <label for="search">Search:</label>
    <input type="text" name="search" id="search" value="{{ request('search') }}">

    <button type="submit">Apply Filters</button>
</form>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Book Name</th>
            <th>Category Name</th>
            <th>Author</th>
            <th>Avg Rating</th>
            <th>Voter</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $key => $book)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $book->name }}</td>
                <td>{{ $book->category->name }}</td>
                <td>{{ $book->author->name }}</td>
                <td>
                    @if ($book->ratings->count() > 0)
                        {{ $book->ratings->avg('rating') }}
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $book->ratings->count() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
