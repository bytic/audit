<?php

/** @var \ByTIC\Audit\Models\AuditTrails\AuditTrail[] $trails */
$trails_repository = \ByTIC\Audit\Utility\AuditModels::trails();

if (count($trails) < 1) {
    echo $this->Messages()->info($trails_repository->getMessage('dnx'));
    return;
}

?>
<table class="table table-striped table-bordered donation-sessions">
    <thead>
    <tr>
        <th>
            <?php echo translator()->trans('event'); ?>
        </th>
        <th>
            <?php echo Users::instance()->getLabel('title.singular'); ?>
        </th>
        <th>
            <?php echo translator()->trans('metadata'); ?>
        </th>
        <th>
            <?php echo translator()->trans('created'); ?>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($trails as $key => $item) { ?>
        <tr>
            <td>
                <?php
                echo $item->getType()->getEntryDescription(); ?>
            </td>
            <td>
                <?php
                $user = $item->getUser(); ?>
                <?php
                echo $user ? $user->getName() : '--'; ?>
            </td>
            <td>
                <?php
                echo nl2br($item->notes); ?>
            </td>
            <td>
                <?php
                echo _strftime(
                    $item->created,
                    Nip_Locale::instance()->getOption(['time', 'dayDateTimeStringFormat'])
                ); ?>
            </td>
        </tr>
        <?php
    } ?>
    </tbody>
</table>