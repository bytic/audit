<?php

/** @var \ByTIC\Audit\Models\AuditTrails\AuditTrail[] $trails */
$trails_repository = \ByTIC\Audit\Utility\AuditModels::trails();

/** @var \ByTIC\Audit\Models\AuditTrails\AuditTrail
 * $trails
 */
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
            <?php echo translator()->trans('user'); ?> //
            <?php echo translator()->trans('created'); ?>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($trails as $key => $item) { ?>
        <?php
        $user = $item->getUser();
        $notes = $item->metadata->get('notes');
        ?>
        <tr>
            <td>
                <?php echo $item->getEvent()->getFormattedMessage(); ?>
                <?php if (!empty($notes)) { ?>
                    <p class="border-top mt-3">
                        <small>
                            <strong>NOTES: </strong>
                            <?= $notes; ?>
                        </small>
                    </p>
                <?php } ?>
            </td>
            <td>
                <div>
                    <span class="badge bg-primary text-white">
                        <?php echo $user ? $user->getName() : '--'; ?>
                    </span>
                </div>
                <small class="d-block">
                    <?php echo $item->performed_at->toDayDateTimeString(); ?>
                </small>
                <small class="d-block">
                    <?php echo $item->created_at->toDayDateTimeString(); ?>
                </small>
            </td>
        </tr>
        <?php
    } ?>
    </tbody>
</table>