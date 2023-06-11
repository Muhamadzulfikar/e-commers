@extends(backpack_view('blank'))

@section('content')
    <main class="main pt-2">


        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb bg-transparent p-0 justify-content-end">
                <li class="breadcrumb-item text-capitalize"><a
                        href="https://demo.backpackforlaravel.com/admin/dashboard">Admin</a></li>
                <li class="breadcrumb-item text-capitalize active" aria-current="page">Dashboard</li>
            </ol>
        </nav>


        <div class="container-fluid animated fadeIn">

            <div name="widget_556949159" section="before_content" class="row">

                <div class="col-sm-6 col-lg-3">
                    <div class="card border-0 text-white bg-primary">
                        <div class="card-body">
                            <div class="text-value">132</div>

                            <div>Registered users.</div>

                            <div class="progress progress-white progress-xs my-2">
                                <div class="progress-bar" role="progressbar" style="width: 13.2%" aria-valuenow="13.2"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <small class="text-muted">868 more until next milestone.</small>
                        </div>

                    </div>
                </div>


                <div class="col-sm-6 col-lg-3">
                    <div class="card border-0 text-white bg-success">
                        <div class="card-body">
                            <div class="text-value">1031</div>

                            <div>Articles.</div>

                            <div class="progress progress-white progress-xs my-2">
                                <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <small class="text-muted">Great! Don't stop.</small>
                        </div>

                    </div>
                </div>


                <div class="col-sm-6 col-lg-3">
                    <div class="card border-0 text-white bg-warning">
                        <div class="card-body">
                            <div class="text-value">15 days</div>

                            <div>Since last article.</div>

                            <div class="progress progress-white progress-xs my-2">
                                <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="30"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <small class="text-muted">Post an article every 3-4 days.</small>
                        </div>

                    </div>
                </div>


                <div class="col-sm-6 col-lg-3">
                    <div class="card border-0 text-white bg-dark">
                        <div class="card-body">
                            <div class="text-value">210</div>

                            <div>Products.</div>

                            <div class="progress progress-white progress-xs my-2">
                                <div class="progress-bar" role="progressbar" style="width: 280%" aria-valuenow="280"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <small class="text-muted">Try to stay under 75 products.</small>
                        </div>

                    </div>
                </div>

            </div>



            <div class="alert alert-warning bg-dark border-0 mb-4" role="alert">


                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>

                <h4 class="alert-heading">Demo Refreshes Every Hour on the Hour</h4>

                <p>At hh:00, all custom entries are deleted, all files, everything. This cleanup is necessary because
                    developers like to joke with their test entries, and mess with stuff. But you know that :-) Go ahead
                    - make a developer smile.</p>

            </div>
        </div>

    </main>
@endsection
