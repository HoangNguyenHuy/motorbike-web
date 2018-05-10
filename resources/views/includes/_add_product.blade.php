<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 01/05/2018
 * Time: 21:56
 */
?>

<div id="_add_lead_modal" class="modal fade add-lead-modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <form autocomplete="off" class="bv-form" id="_form-add-lead" method="POST" action="/candidate/add" novalidate="novalidate">
                    <div>
                        <div class="new-product">
                            add images
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label ">tên xe</label>
                                <div class="controls">
                                    <input class="ai-input form-control " name="name" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="license_plates" class="control-label ">bien so</label>
                                <div class="controls">
                                    <input class="ai-input form-control " name="license_plates" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="certificate" class="control-label ">Giay to xe</label>
                                <div class="controls">
                                    <input name="certificate" type="checkbox">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price" class="control-label ">gia</label>
                                <div class="controls">
                                    <input class="ai-input form-control " name="price" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr class="margin-top-0">
                            <label>thông số:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="number_chassis" class="control-label ">So khung</label>
                                <div class="controls">
                                    <input class="ai-input form-control " name="number_chassis" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="number_engine" class="control-label ">so may</label>
                                <div class="controls">
                                    <input class="ai-input form-control " name="number_engine" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label ">Dung tich xy lanh</label>
                                <div class="form-group">
                                    <div class="controls">
                                        <select class="ai-input form-control" name="capacity">
                                            <option value="US" selected="selected">United States</option>
                                            <option value="CA">Canada</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label ">loai xe</label>
                                <div class="form-group">
                                    <div class="controls">
                                        <select class="ai-input form-control" name="type">
                                            <option value="US" selected="selected">United States</option>
                                            <option value="CA">Canada</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        màu
                    </div>
                    <div class="group-btn">
                        <div class="row">
                            <div class="col-xs-3 col-md-3">
                                <button class="btn btn-default btn-cancel" type="button">Cancel</button>
                            </div>
                            <div class="col-xs-3 col-md-3 pull-right">
                                <button class="btn btn-primary btn-add" type="button">Add</button>
                            </div>
                        </div>
                    </div>g
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
