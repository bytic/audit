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
            <?php echo translator()->trans('user'); ?>
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
                <?php echo $item->getEvent()->getFormattedMessage(); ?>
            </td>
            <td>
                <?php
                $user = $item->getUser(); ?>
                <?php
                echo $user ? $user->getName() : '--'; ?>
            </td>
            <td>
                <div style="display: block">
                    <?php echo $item->performed_at->toDayDateTimeString(); ?>
                </div>
                <div style="display: block">
                    <?php echo $item->created_at->toDayDateTimeString(); ?>
                </div>
            </td>
        </tr>
        <?php
    } ?>
    </tbody>
</table>