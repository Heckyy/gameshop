@extends('master')
@section('content')
    <div class="custom-product">
        <div class="col-sm-15">
            <table class="table">

                <tbody>
                    <tr>
                        <td>Amount</td>
                        <td>Rp {{ $total }}</td>
                    </tr>
                    <tr>
                        <td>Tax</td>
                        <td>Rp.{{ ($total * 1) / 100 }}</td>
                    </tr>
                    <tr>
                        <td>Service</td>
                        <td>Rp.5000</td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td>Rp.{{ $total + 5000 + ($total * 1) / 100 }}</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <form action="/orderplace" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="address" placeholder="Enter your email address" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Payment Method:</label><br><br>
                        <input type="radio" value="Ovo" name="payment"><span>Ovo</span><br><br>
                        <input type="radio" value="Gopay" name="payment"><span>Gopay</span><br><br>
                        <input type="radio" value="Bank Transfer" name="payment"><span>Bank Transfer</span><br><br>
                        <label for="proof">Proof of Payment:</label><br><br>
                        <input type="file" name="proof" accept="image/*" class="storeOrder"><br>
                    </div>
                    <button type="submit" class="btn btn-default">Order Now</button>
                </form>
            </div>
        </div>
    </div>
@endsection
