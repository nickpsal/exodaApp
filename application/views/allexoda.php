<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php $this->load->view('includes/header'); ?>

<div class="container">
    <div class="row">
        <div class="card mt-3">
            <div class="card-head">
                <?=$title?>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading page-title" style="display: box; text-align: center;">
                        </div>
                        <div class="panel-body">
                            <button type="button" class="btn btn-primary" onclick="openInsertModal()">Insert New</button>
                            <button type="button" class="btn btn-primary" onclick="openSumModal()">Sum of all Exoda</button>
                            <table id="myTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>Renew Type</th>
                                        <th>Valid Until</th>
                                        <th>Price</th>
                                        <th>Autopay</th>
                                        <th>Date Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer'); ?>