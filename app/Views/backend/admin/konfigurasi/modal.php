<div class="modal" id="modal_form">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header bg-primary-700 bg-success-gradient pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" id="gantijudul">UBAH KONFIGURASI</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" name="form" method="post" enctype="multipart/form-data" id="form"
                  action="javascript:save();">
                <div class="modal-body pd-25">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" readonly value="" name="key" id="key">
                            </div>
                        </div>

                        <div class="col-sm-12">

                            <div class="form-group" id="komponen">
                                <input type="hidden" name="id" id="id">
                                <!--								<input type="hidden" name="key" id="key">-->
                                <div>

                                </div>
                                <span class="invalid-feedback" id="error_content"></span>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" type="submit"
                            id="btnsavex"><i class="mdi mdi-content-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
