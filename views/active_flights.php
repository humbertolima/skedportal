<div>
    <div>
        <h2>Active Flights</h2>
    </div>
    <table width=100% class="table">
        <thead>
            <tr>
                <td><b>Flight Number</b></td>
                <td><b>Crew</b></td>
                <td><b>Date</b></td>
                <td><b>Depart</b></td>
                <td><b>Start Time</b></td>
                <td><b>Arrive</b></td>
                <td><b>End Time</b></td>
            </tr>
        </thead>
        <tbody>
            <?php date_default_timezone_set("America/New_York"); ?>
                <?php foreach ($flights as $flight): ?>
                    <?php if ($flight["flight-date"] == date("Y-m-d") && $flight["flight-start"] <= date('g:i A') ): ?>
                        <?php if ($flight["completed"] == 0): ?>
                            <tr>
                                <td>
                                    <?= $flight["flight-number"] ?>
                                </td>
                                <td width="30%" style="font-size:9px">
                                    <?php if ($flight["assigned"] == 1): ?>
                                        <table>
                                            <tr>
                                                Cpt:
                                                <?= $flight["captain"] ?> | FO:
                                                    <?= $flight["first-officer"] ?> | FAL:
                                                        <?= $flight["fa-lead"] ?> | FA1:
                                                            <?= $flight["fa-1"] ?>
                                            </tr>
                                            <tr>
                                                FA2:
                                                <?= $flight["fa-2"] ?> | FA3:
                                                    <?= $flight["fa-3"] ?> | FA4:
                                                        <?= $flight["fa-4"] ?> | FA5:
                                                            <?= $flight["fa-5"] ?>
                                            </tr>
                                        </table>
                                        <?php else: ?>

                                            <?php endif ?>
                                </td>
                                <td>
                                    <?= $flight["flight-date"] ?>
                                </td>
                                <td>
                                    <?= $flight["flight-depart"] ?>
                                </td>
                                <td>
                                    <?= $flight["flight-start"] ?>
                                </td>
                                <td>
                                    <?= $flight["flight-arrive"] ?>
                                </td>
                                <td>
                                    <?= $flight["flight-end"] ?>
                                </td>
                                <td>
                                    <button class="btn btn-success btn-xs" type="button" onclick="endFlightBtn(this.id)" id="<?= $flight['flight-number'] ?>">
                                        <span aria-hidden="true" class="glyphicon glyphicon-ok"></span> End Flight
                                    </button>
                                </td>
                            </tr>
                            <?php endif ?>
                                <?php endif ?>
                                    <?php endforeach ?>
        </tbody>
    </table>
</div>