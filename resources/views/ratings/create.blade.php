
<h1>Rate a Book</h1>

<form action="{{ route('ratings.store') }}" method="post">
    @csrf

    <label for="book">Book:</label>
    <select name="book" id="book">
        @foreach ($books as $book)
            <option value="{{ $book->id }}">{{ $book->name }} by {{ $book->author->name }}</option>
        @endforeach
    </select>

    <label for="rating">Rating:</label>
    <select name="rating" id="rating">
        @for ($i = 1; $i <= 10; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>

    <button type="submit">Submit Rating</button>
</form>