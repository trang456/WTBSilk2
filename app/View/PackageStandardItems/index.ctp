<?php $this->Html->addCrumb('My Package Standard Items', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Standard Items</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Package Standard Item', '/package_standard_items/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('PackageStandardItem', array('class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 

                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('area_name', array('value' => ''  , 'placeholder' => '--Input Text Area--', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
              <!--  <div class="row" id="search_panel_controls">
                    
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Continent:</label>
                        <?php echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'value' => $continent_id)); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'value' => $country_id)); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('city_id', array('options' => $TravelCities, 'empty' => '--Select--', 'value' => $city_id)); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Suburb:</label>
                        <?php echo $this->Form->input('suburb_id', array('options' => $TravelSuburbs, 'empty' => '--Select--', 'value' => $suburb_id)); ?>
                    </div>



                    <div class="col-sm-3 col-xs-6">
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
// echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div> -->
                <?php echo $this->Form->end(); ?>
            </div>
           <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                      <tr>
                        <th data-toggle="phone">StandardPackageId</th>
                        <th data-toggle="phone" data-sort-ignore="true" >StandardPackageCode</th>                       
                        <th data-hide="phone" data-sort-ignore="true">PackageItemTypeId</th>
                        <th data-hide="phone" data-sort-ignore="true">PackageItemType</th>
                        <th data-hide="phone" data-sort-ignore="true">ItemCodeId</th>
                        <th data-hide="phone" data-sort-ignore="true">ItemCodeIdLinked</th>
                        <th data-hide="phone" data-sort-ignore="true">PackageItemOrder1</th>
                        <th data-hide="phone" data-sort-ignore="true">PackageItemOrder2</th>
                        <th data-hide="phone" data-sort-ignore="true">PackageItemOrder3</th>
                        <th data-hide="phone" data-sort-ignore="true">PackageItemOrder4</th>
                        <th data-hide="phone" data-sort-ignore="true">PackageItemOrder5</th>
                        <th data-hide="phone" data-sort-ignore="true">ItemName</th>
                        <th data-hide="phone" data-sort-ignore="true">PackageItemCountryCode</th>
                        <th data-hide="phone" data-sort-ignore="true">PackageItemCityCode</th>
                        <th data-hide="all" data-sort-ignore="true">ItemSummaryShort</th>
                        <th data-hide="all" data-sort-ignore="true">ItemSummary</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($PackageStandardItems) && count($PackageStandardItems) > 0):
                        foreach ($PackageStandardItems as $PackageStandardItem):
                            $id = $PackageStandardItem['PackageStandardItem']['id'];
                           
                            ?>
                            <tr>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['StandardPackageId']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['StandardPackageCode']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['PackageItemTypeId']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['PackageItemType']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['ItemCodeId']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['ItemCodeIdLinked']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['PackageItemOrder1']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['PackageItemOrder2']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['PackageItemOrder3']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['PackageItemOrder4']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['PackageItemOrder5']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['ItemName']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['PackageItemCountryCode']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['PackageItemCityCode']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['ItemSummaryShort']; ?></td>
                                <td><?php echo $PackageStandardItem['PackageStandardItem']['ItemSummary']; ?></td>
                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="3" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Package Standard Item', '/package_standard_items/add') ?></span>

        </div>
    </div>
</div>
