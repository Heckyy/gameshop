@extends('master')
@section('content')
    <h1>Upload</h1>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>Price:</label>
            <input type="number" name="price" class="form-control" placeholder="Enter price" required>
        </div>
        <div class="form-group">
            <label>Category:</label>
            <select name="category" class="form-control" required>
                <option value="item">Item</option>
                <option value="diamond">Diamond</option>
                <option value="akun">Akun</option>
            </select>
        </div>
        <div class="form-group">
            <label>Description:</label>
            <input type="text" name="description" class="form-control" placeholder="Enter Description" required>
        </div>
        <div class="form-group">
            <label>Photo:</label>
            <input type="file" name="gallery" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Sell Item</button>
    </form>
@endsection
