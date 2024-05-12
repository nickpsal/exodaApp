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
            <form id="exodaForm" method="post" action="<?= base_url('exoda/postExoda') ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="Description" name="Description" required>
                    </div>
                    <div class="mb-3">
                        <label for="Price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="Price" name="Price" required>
                    </div>
                    <div class="mb-3">
                        <label for="exodoMonth" class="form-label">Month</label>
                        <select class="form-control" id="exodoMonth" name="exodoMonth" required>
                            <option value="1">Jan</option>
                            <option value="2">Feb</option>
                            <option value="3">Mar</option>
                            <option value="4">Apr</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">Aug</option>
                            <option value="9">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exodoMonth" class="form-label">Month</label>
                        <select class="form-control" id="exodoYear" name="exodoYear" required>
                            <?php
                            $startYear = 2024;
                            $currentYear = date('Y');
                            if ($currentYear > $startYear) {
                                for ($j = $startYear; $j <= $currentYear; $j++) {
                            ?>
                                    <option value="<?= $j ?>"><?= $j ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="<?= $currentYear ?>"><?= $currentYear ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Repeated" class="form-label">Repeated</label>
                        <select class="form-control" id="Repeated" name="Repeated" required>
                            <option value="0">True</option>
                            <option value="1">False</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="AutoRenew" class="form-label">AutoRenew</label>
                        <select class="form-control" id="AutoRenew" name="AutoRenew" required>
                            <option value="0">True</option>
                            <option value="1">False</option>
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
            <form id="editExodaForm" method="post" action="<?= base_url('exoda/putExoda') ?>">
                <div class="modal-body">
                    <input type="text" class="form-control" id="ID" name="ID" hidden>
                    <div class="mb-3">
                        <label for="updateDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="updateDescription" name="updateDescription" required>
                    </div>
                    <div class="mb-3">
                        <label for="updatePrice" class="form-label">Price</label>
                        <input type="text" class="form-control" id="updatePrice" name="updatePrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateExodoMonth" class="form-label">Month</label>
                        <select class="form-control" id="updateExodoMonth" name="updateExodoMonth" required>
                            <?php
                            for ($i = 1; $i < 13; $i++) {
                            ?>
                                <option value="<?= $i ?>"><?= date('F', mktime(0, 0, 0, $i, 1)); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exodoMonth" class="form-label">Month</label>
                        <select class="form-control" id="updateExodoYear" name="updateExodoYear" required>
                            <?php
                            $startYear = 2024;
                            $currentYear = date('Y');
                            if ($currentYear > $startYear) {
                                for ($j = $startYear; $j <= $currentYear; $j++) {
                            ?>
                                    <option value="<?= $j ?>"><?= $j ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="<?= $currentYear ?>"><?= $currentYear ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="updateRepeated" class="form-label">Repeated</label>
                        <select class="form-control" id="updateRepeated" name="updateRepeated" required>
                            <option value="0">True</option>
                            <option value="1">False</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="updateAutoRenew" class="form-label">AutoRenew</label>
                        <select class="form-control" id="updateAutoRenew" name="updateAutoRenew" required>
                            <option value="0">True</option>
                            <option value="1">False</option>
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

<!-- Choose Month and Year Modal -->
<!-- Modal HTML -->
<div class="modal fade" id="chooseMonthModal" tabindex="-1" aria-labelledby="chooseMonthModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content mx-auto p-2">
            <div class="row">
                <div class="col-6 month mt-2 mb-2">
                    <select class="w-100 mt-4" id="MonthSelector" name="MonthSelector" required>
                        <?php
                        $currentMonth = date('m');
                        echo "<option value='-'>Select Month</option>";
                        for ($i = 1; $i < $currentMonth; $i++) {
                        ?>
                            <option value="<?= $i ?>"><?= date('F', mktime(0, 0, 0, $i, 1)); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-6 year mt-2 mb-2">
                    <select class="w-100 mt-4" id="YearSelector" name="YearSelector" required>
                        <?php
                        $startYear = 2024;
                        $currentYear = date('Y');
                        echo "<option value='-'>Select Year</option>";
                        if ($currentYear > $startYear) {
                            for ($j = $startYear; $j <= $currentYear; $j++) {
                        ?>
                                <option value="<?= $j ?>"><?= $j ?></option>
                            <?php
                            }
                        } else {
                            ?>
                            <option value="<?= $currentYear ?>"><?= $currentYear ?></option>
                        <?php
                        } ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center" style="white-space: nowrap;">
                <div class="row">
                    <div class="col-4">
                        <button type="button" class="btn btn-primary" id="ChooseMonthandYear">Ok</button>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="col-4">
                        <a href="<?= base_url() ?>" class="btn btn-primary">Current Month</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>