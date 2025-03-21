<?php
    $employee_id =  $_GET['emp_id'] ?? null;
    $employee = $DB->SELECT_ONE_WHERE("employees", "*", ["employee_id" => $employee_id]);

    $benefits = $DB->SELECT("benefits","*");

    $benefits_compensation = $DB->SELECT_WHERE("benefits_compensation","*", ["employee_id" => $employee_id]);

?>

<div class="page-content">

    <?php
        Breadcrumb([
            ['label' => 'Home', 'url' => '/dashboard'],
            ['label' => 'Benefits & Compensation', 'url' => '/benefits-compensation'],
            ['label' => 'Details'],
        ]);
    ?>

    <div class="panel h-full flex-col mb-5">
        <div class="flex flex-col items-center justify-center">
            <div class="flex flex-col items-center justify-center">
                <div class="w-[100px] mb-2" id="previewPicture">
                    <img src="<?= DOMAIN ?>/upload/profile/default.png" alt="image" id="profileImage" class="mb-4 h-24 w-24 rounded-full object-cover">
                </div>
                <div class="text-xs font-bold">EMP ID: <?=$employee['employee_id']?></div>
                <h2 class="text-xl font-bold"><?=$employee['firstname'].' '.$employee['lastname']?></h2>
            </div>
        </div>
    </div>
    
    <div class="mb-5 grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-2">
        <div class="panel">
            <table>
                <tr>
                    <td>Benefit</td>
                    <td>
                        <div class="flex justify-end">
                            <button class="btn btn-dark btn-sm mb-4" id="btnAddBenefit">Add Benefits</button>
                        </div>
                        <select class="form-input" id="benefit_type">
                            <?php foreach($benefits as $benefit){ ?>
                                <option><?=$benefit['type']?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td>
                        <input type="number" id="benefit_amount" class="form-input" placeholder="0.00">
                    </td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td class="flex justify-end">
                        <button class="btn btn-primary" id="btnAddCompensation">Add Compensation</button>
                    </td>
                </tr>
            </table>
        </div>
        <div class="panel">
            <?php if(empty($benefits_compensation)){ ?>
                <div class="flex items-center justify-center h-full">
                    <div class="font-bold">No Benefits & Compensation Available</div>
                </div>
            <?php }else{ ?>
                <table class="table-bordered">
                    <?php foreach($benefits_compensation as $data){ ?>
                        <tr>
                            <td><?=$data['type']?></td>
                            <td class="font-bold"><?=PESO($data['amount'])?></td>
                            <td><i class="bi bi-pencil-square btnEdit" data-benefit_id="<?=$data['id']?>"></i></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        </div>
    </div>


    <div id="responseBenefits"></div>
    <script>
        $('#btnAddCompensation').click(function(){
            const employee_id = '<?=$employee_id?>';
            const type = $('#benefit_type').val();
            const amount = $('#benefit_amount').val();
            btnLoading('#btnAddCompensation');
            $.post("<?=ROUTE('api/benefits/add_compensation.php')?>", {
                employee_id:employee_id,
                type: type,
                amount: amount
            }, function(res){
                $('#responseBenefits').html(res);
                btnLoadingReset('#btnAddCompensation');
            });
        });

        $('#btnAddBenefit').click(function(){
            const benefit = prompt("Enter Benefit:");
            btnLoading('#btnAddBenefit');
            $.post("<?=ROUTE('api/benefits/add_benefit.php')?>", {
                type: benefit,
            }, function(res){
                $('#responseBenefits').html(res);
                btnLoadingReset('#btnAddBenefit');
            });
        });

        $('.btnEdit').click(function(){
            const benefit_id = $(this).data('benefit_id');
            const amount = prompt("Enter Amount:", $(this).closest('tr').find('td:nth-child(2)').text().replace('₱', '').replace(',', ''));
            if (amount === null) {
                return;
            }
            $.post("<?=ROUTE('api/benefits/update_compensation.php')?>", {
                benefit_id: benefit_id,
                amount:amount
            }, function(res){
                $('#responseBenefits').html(res);
            });
        });

    </script>

</div>