<div class="form-resize">
    <form action="maint_users.php" method="post" class="form-inline">
        <table class="table">
            <fieldset>
                <thead>
                    <tr>
                        <td><b>First Name</b></td>
                        <td><b>Last Name</b></td>
                        <td><b>Username</b></td>
                        <td><b>Password</b></td>
                        <td><b>Email</b></td>
                        <td><b>Permissions</b></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input size="14%" autocomplete="off" autofocus class="form-control" name="first-name" placeholder="First Name" type="text" />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input size="14%" class="form-control" name="last-name" placeholder="Last Name" type="text" />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input size="14%" class="form-control" name="username" placeholder="Username" type="text" />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input size="14%" class="form-control" name="password" placeholder="Password" type="password" />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input size="14%" class="form-control" name="email" placeholder="name@example.com" type="email" />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <select width="14%" class="form-control" name="permissions">
                                    <option> </option>
                                    <option value="Admin">Admin</option>
                                    <option value="Pilot">Pilot</option>
                                    <option value="FA">FA</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <button class="btn btn-default" type="submit">
                                    <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span> Add User
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </fieldset>
        </table>
    </form>
</div>
<br>
<br>
<div>
    <h2>Registered Users</h2>
</div>
<br>
<div>
    <form action="search_user.php" method="post" class="form-inline">
        <div class="form-group">
            <select width="30%" class="form-control" name="search-box">
                <option> </option>
                <?php foreach ($searchSelect as $selection): ?>
                    <?php if ($selection["permissions"] == "Pilot"): ?>
                        <option value="<?= $selection['username'] ?>">
                            <?= $selection['last-name'] ?>,
                                <?= $selection['first-name'] ?> | "Pilot"
                        </option>
                        <?php elseif ($selection["permissions"] == "FA"): ?>
                            <option value="<?= $selection['username'] ?>">
                                <?= $selection['last-name'] ?>,
                                    <?= $selection['first-name'] ?> | "FA"
                            </option>
                            <?php elseif ($selection["permissions"] == "Admin"): ?>
                                <option value="<?= $selection['username'] ?>">
                                    <?= $selection['last-name'] ?>,
                                        <?= $selection['first-name'] ?> | "Admin"
                                </option>
                                <?php endif ?>
                                    <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-search"></span> Search
            </button>
        </div>
    </form>
</div>
<br>
<?php if ($searchSelect[0]["search"] == 1): ?>
    <table class="table">
        <fieldset>
            <thead>
                <tr>
                    <td><b>User ID</b></td>
                    <td><b>First Name</b></td>
                    <td><b>Last Name</b></td>
                    <td><b>Username</b></td>
                    <td><b>Email</b></td>
                    <td><b>Permissions</b></td>
                    <td><b>Total Hours</b></td>
                    <td><b>Current Hours</b></td>
                    <td><b>Availability</b></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <?= $user["user-id"] ?>
                        </td>
                        <td>
                            <?= $user["first-name"] ?>
                        </td>
                        <td>
                            <?= $user["last-name"] ?>
                        </td>
                        <td>
                            <?= $user["username"] ?>
                        </td>
                        <td>
                            <?= $user["email"] ?>
                        </td>
                        <td>
                            <?= $user["permissions"] ?>
                        </td>
                        <td>
                            <?= $user["total-hours"] ?>
                        </td>
                        <td>
                            <?= $user["current-hours"] ?>
                        </td>
                        <td>
                            <?php if ($user["availability"] == 1): ?>
                                <svg height="30" width="30">
                                    <circle cx="15" cy="15" r="7" stroke="black" stroke-width="1" fill="green" />
                                </svg>
                                <?php else: ?>
                                    <svg height="30" width="30">
                                        <circle cx="15" cy="15" r="7" stroke="black" stroke-width="1" fill="red" />
                                    </svg>
                                    <?php endif ?>
                        </td>
                        <td align="right" width="30%">
                            <button class="btn btn-warning btn-xs" id="<?= $user['user-id'] ?>" onclick="editUserBtn(this.id)" type="button">
                                <span aria-hidden="true" class="glyphicon glyphicon-edit"></span> Edit User
                            </button>
                            <button class="btn btn-info btn-xs" onclick="passResetBtn(this.id)" id="<?= $user['user-id'] ?>" type="button">
                                <span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign"></span> Reset Password
                            </button>
                            <button class="btn btn-danger btn-xs" onclick="delUserBtn(this.id)" id="<?= $user['user-id'] ?>" type="button">
                                <span aria-hidden="true" class="glyphicon glyphicon-remove"></span> Delete User
                            </button>
                        </td>
                    </tr>
                    <?php endforeach ?>
            </tbody>
        </fieldset>
    </table>
    <?php else: ?>
        <?php endif ?>