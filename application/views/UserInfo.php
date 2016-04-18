<table class="CSSTableGenerator">
    {userInformation}
    <tr>
        <td rowspan="3">
            {avatar}
        </td>
        <td>Username</td>
        <td>{username}</td>
    </tr>
    <tr>
        <td>Cash</td>
        <td>{cash}</td>
    </tr>
    <tr>
        <td>Role</td>
        <td>{role}</td>
    </tr>
    {/userInformation}

</table>


<div class="upload" action="dashboard/upload">
    <form method="POST" enctype="multipart/form-data" id="imageform">
       <br>
       <input type="file" name="avatarimg" id="photoimg" >
       <br>
       <input type="submit" name="avatarUp" value="UPLOAD">
    </form>
</div>