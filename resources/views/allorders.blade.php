@extends('master')
@section('content')
    <div class="custom-product">
        <div class="col-sm-8">
            <div class="trending-wrapper">
                <h4>All Orders</h4>
                @foreach ($orders as $item)
                    <div class="row searched-item cart-list-devider">
                        <div class="col-sm-3">
                            <a href="detail/{{ $item->id }}">
                                <img class="trending-image" src="{{ asset('storage/images/' . $item->gallery) }}">
                            </a>
                        </div>
                        <div class="col-sm-9">
                            <div class="order-details">
                                <h2 class="myorder">{{ $item->name }}</h2>
                                <div class="order-info">
                                    <div class="order-info-item ">
                                        <span class="label" style="color: #000;">Id Order:</span>
                                        <span class="value" id="id-order"
                                            value="{{ $item->id }}">{{ $item->id }}</span>
                                    </div>
                                    <div class="order-info-item">
                                        <span class="label" style="color: #000;">Delivery Status:</span>
                                        <span class="value">{{ $item->status }}</span>
                                    </div>
                                    <div class="order-info-item">
                                        <span class="label" style="color: #000;">Address:</span>
                                        <span class="value">{{ $item->address }}</span>
                                    </div>
                                    <div class="order-info-item">
                                        <span class="label" style="color: #000;">Payment Status:</span>
                                        <span class="value">{{ $item->payment_status }}
                                            <button type="button" class="btn btn-transparent" data-toggle="modal"
                                                data-target="#myModal" onclick="changeId({{ $item->id }});">
                                                <img src="{{ asset('storage/images/editing.png') }}" width="18"
                                                    alt="">
                                            </button>
                                    </div>
                                    <div class="order-info-item">
                                        <span class="label" style="color: #000;">Payment Method:</span>
                                        <span class="value">{{ $item->payment_method }}</span>
                                    </div>
                                    <div class="order-info-item">
                                        <span class="label" style="color: #000;">Seller:</span>
                                        <span class="value">{{ $item->created_by }}</span>
                                    </div>
                                    <div class="order-info-item">
                                        <span class="label" style="color: #000;">Buyer:</span>
                                        <span class="value">{{ $item->buyer_name }}</span>
                                    </div>
                                    <div class="order-info-item">
                                        <span class="label" style="color: #000;">Proof of Payment:</span>
                                        <span class="value">
                                            @if ($item->proof)
                                                @php
                                                    $proofPath = ltrim($item->proof, '/');
                                                @endphp
                                                <a href="{{ asset($proofPath) }}" target="_blank">Open Proof</a>
                                            @else
                                                No proof of payment provided.
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Modals --}}
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Payment Status</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body ">
                                    <form action="" method="POST">
                                        @csrf
                                        <h6>Id Order : <span id="id-change">{{ $item->id }}</span> </h6>
                                        <h6>Payment Status : </h6>
                                        <select name="payment-status" id="payment-status">
                                            <option value="null">Select</option>
                                            <option value="pending">Pending</option>
                                            <option value="success">Success</option>
                                            <option value="canceled">Canceled</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary"
                                        onclick="editPayment({{ $item->id }})">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/paymentstatus.js') }}"></script>
@endsection
