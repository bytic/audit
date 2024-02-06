<?php

declare(strict_types=1);

/** @var \ByTIC\Audit\Models\AuditTrails\AuditTrail[] $trails */

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

$trails_repository = \ByTIC\Audit\Utility\AuditModels::trails();

/** @var \ByTIC\Audit\Models\AuditTrails\AuditTrail
 * $trails
 */
if (count($trails) < 1) {
    echo $this->Messages()->info($trails_repository->getMessage('dnx'));
    return;
}

$cloner = new VarCloner();
$dumper = new HtmlDumper();
$dumper->setTheme('light');
?>
<table class="table table-striped table-bordered donation-sessions">
    <thead>
    <tr>
        <th>
            <?= translator()->trans('event'); ?>
        </th>
        <th>
            <?= translator()->trans('user'); ?> //
            <?= translator()->trans('created'); ?>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($trails as $key => $item) { ?>
        <?php
        $user = $item->getUser();
        $meta = $item->metadata->toArray();
        ?>
        <tr>
            <td>
                <?= $item->getEvent()->getFormattedMessage(); ?>
                <p class="border-top mt-3">
                    <small>
                        <?= $dumper->dump($cloner->cloneVar($meta), true); ?>
                    </small>
                </p>
            </td>
            <td>
                <div>
                    <span class="badge bg-primary text-white">
                        <?= $user ? $user->getName() : '--'; ?>
                    </span>
                </div>
                <small class="d-block">
                    <?= $item->performed_at->toDayDateTimeString(); ?>
                </small>
                <small class="d-block">
                    <?= $item->created_at->toDayDateTimeString(); ?>
                </small>
            </td>
        </tr>
        <?php
    } ?>
    </tbody>
</table>