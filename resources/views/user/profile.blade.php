@extends('sbadmin.layout')

@section('main')
    <style>
        .card{
            border:none;

            position:relative;
            overflow:hidden;
            border-radius:8px;
            cursor:pointer;
        }

        .card:before{
            
            content:"";
            position:absolute;
            left:0;
            top:0;
            width:4px;
            height:100%;
            background-color:#efbebe;
            transform:scaleY(1);
            transition:all 0.5s;
            transform-origin: bottom
        }

        .card:after{
            
            content:"";
            position:absolute;
            left:0;
            top:0;
            width:4px;
            height:100%;
            background-color:#ff0707;
            transform:scaleY(0);
            transition:all 0.5s;
            transform-origin: bottom
        }

        .card:hover::after{
            transform:scaleY(1);
        }


        .fonts{
            font-size:11px;
        }

        .social-list{
            display:flex;
            list-style:none;
            justify-content:center;
            padding:0;
        }

        .social-list li{
            padding:10px;
            color:#8E24AA;
            font-size:19px;
        }


        .buttons button:nth-child(1){
            border:1px solid #ff0000A !important;
            color:#ff0000;
            height:40px;
        }

        .buttons button:nth-child(1):hover{
            border:1px solid #ff0000 !important;
            color:#fff;
            height:40px;
            background-color:#ff0000;
        }

        .buttons button:nth-child(2){
            border:1px solid #ff0000 !important;
            background-color:#ff0000;
            color:#fff;
                height:40px;
        }
    </style>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- End of Sidebar -->
        
            <div class="container">

                <div class="row d-flex justify-content-center" style="margin-top: 30px;">
        
                    <div class="col-lg-7">
                        
                        <div class="card p-3 py-4 border shadow-lg  ">
                            
                            <div class="text-center">
                                <img src="{{ auth()->user()->foto == 'default.jpeg' ? asset('sbadmin/img/undraw_profile.svg') : asset('storage/' . auth()->user()->foto ) }}" width="200" class="rounded shadow-lg img-thumbnail">
                            </div>
                            
                            <div class="text-center mt-3">
                                <h3 class="mt-2 mb-0 text-uppercase">profile</h3>
                                
                                <div class="datadiri mt-3 text-dark">
                                    <p>Status : <span class="text-success text-uppercase">{{ auth()->user()->role }}</span></p>
                                    <p>Name : {{ auth()->user()->name }}</p>
                                    <p>Email : {{ auth()->user()->email }}</p>
                                    @if ( auth()->user()->role == 'petani')
                                    <p>Alamat Rumah : {{ auth()->user()->alamat_rumah }}</p>
                                    <p>Alamat Lahan : {{ auth()->user()->alamat_lahan }}</p>
                                    <p>Luas Lahan : {{ auth()->user()->luas_lahan }} ( m2 )</p>
                                    <p>Jenis Tanaman : {{ auth()->user()->jenis_tanaman }}</p>
                                    @endif
                                    <p>Created : {{ auth()->user()->created_at }}</p>
                                </div>
                                
                                <div class="buttons">
                                    
                                    <a class="btn btn-outline-danger px-4" href="{{ url('home') }}">Back To Dashboard</a>
                                    <a class="btn btn-danger px-4 ms-3" href="{{ url('user/setting/' . auth()->user()->id ) }}">Settings</a>
                                </div>
                                
                                
                            </div>
                            
                           
                            
                            
                        </div>
                        
                    </div>
                    
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            
            <!-- End of Footer -->

        </div>        

@endsection

