<form action="{{ route('escorts.import') }}" style="margin:10px" method="POST" enctype="multipart/form-data" class="submit-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" name="file" class="form-control">

                                </div>
                                  <div class="col-md-6">
                                     <button type="submit" class="btn btn-success rounded-btn"><i class="fa fa-file"></i> استيراد</button>

                                  </div>
                            </div>                           
                        </form>