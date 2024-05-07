<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php $this->load->view('includes/header'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <caption>Exoda</caption>
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
<?php $this->load->view('includes/footer'); ?>