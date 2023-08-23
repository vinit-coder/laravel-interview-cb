<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <title>Book Tickets</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4" style="float:none!important;margin: auto;margin-top:10% !important;">

                <h2 style="margin-left: 85px;">Book Tickets</h2>
                @if (session()->has('message'))
                    <div class="alert alert-danger" role="alert">
                         {{session('message')}}
                         @php
                            $suggestions= session('suggestions');
                         @endphp
                         

                         </br>
                        <h2>Available Options </h2>
                        @foreach ($suggestions as $suggestion)
                        <p> 
                           
                            {{implode(",", $suggestion)}} 
                            
                        </p>   
                         @endforeach
                        
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                        </br>
                        <h2> Booked Seats </h2>
                        @php
                                $res = session('res');
                                $booked_seats = $res['booked_seats'];
                        @endphp
                        <p> 
                            {{implode(",",$booked_seats)}}
                        </p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif

                <form id="form" action = "{{route('book.seat')}}" method="post">
                    @csrf

                    <label for="seat" class="col-form-control">Preffered Seat</label>
                    <input type="text" name="seat" id="seat" class="form-control" placeholder = "for example: A10" />


                    <label for="number" class="col-form-control" style="margin-top: 10px;">Total Tickets</label>
                    <input type="text" name="number" id="number" class="form-control" placeholder="for example: 4" />
                    <button class="btn btn-primary subbtn" style="margin-top:10px; width: 100%;">Submit</button>
                </form>

                

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        
</body>

</html>
