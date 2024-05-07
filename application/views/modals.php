<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Insert Exoda Modal -->
<div class="modal fade" id="insertExodaModal" tabindex="-1" aria-labelledby="insertExodaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="insertExodaModalLabel">Insert new Exodo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="exodaForm" method="post" action="<?=base_url('exoda/postExoda')?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="Description" name="Description" required>
                    </div>
                    <div class="mb-3">
                        <label for="RenewType" class="form-label">Renew Type</label>
                        <select class="form-control" id="RenewType" name="RenewType" required>
                            <option value="Month">Month</option>
                            <option value="Year">Year</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ValidUntil" class="form-label">Valid Until</label>
                        <input type="text" class="form-control" id="ValidUntil" name="ValidUntil" required>
                    </div>
                    <div class="mb-3">
                        <label for="Price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="Price" name="Price" required>
                    </div>
                    <div class="mb-3">
                        <label for="Autopay" class="form-label">Autopay</label>
                        <select class="form-control" id="Autopay" name="Autopay" required>
                            <option value="True">True</option>
                            <option value="False">False</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Exoda Modal -->
<div class="modal fade" id="UpdateExodaModal" tabindex="-1" aria-labelledby="UpdateExodaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="UpdateExodaModalLabel">Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editExodaForm" method="post" action="<?=base_url('exoda/putExoda')?>">
                <div class="modal-body">
                    <input type="text" class="form-control" id="ID" name="ID" hidden>
                    <div class="mb-3">
                        <label for="updateDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="updateDescription" name="updateDescription" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateRenewType" class="form-label">Renew Type</label>
                        <select class="form-control" id="updateRenewType" name="updateRenewType" required>
                            <option value="Month">Month</option>
                            <option value="Year">Year</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="updateValidUntil" class="form-label">Valid Until</label>
                        <input type="text" class="form-control" id="updateValidUntil" name="updateValidUntil" required>
                    </div>
                    <div class="mb-3">
                        <label for="updatePrice" class="form-label">Price</label>
                        <input type="text" class="form-control" id="updatePrice" name="updatePrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateAutoPay" class="form-label">Autopay</label>
                        <select class="form-control" id="updateAutoPay" name="updateAutopay" required>
                            <option value="True">True</option>
                            <option value="False">False</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Exoda Modal -->
<!-- Modal HTML -->
<div id="deleteConfirmationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelDeleteButton">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- General Modal -->
<!-- Modal HTML -->
<div class="modal fade" id="generalModal" tabindex="-1" aria-labelledby="generalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="message" id="message">
                <h5 class="modal-title" id="generalModalLabel"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeCustom">OK</button>
            </div>
        </div>
    </div>
</div>