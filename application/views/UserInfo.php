<table class="CSSTableGenerator"  cellpadding="3">
    {userInformation}
    <tr>
        <td colspan="3">
        User Information
        </td>
    </tr>
    <tr>
        <td rowspan="3"  style="margin:0px" width="20%">
            {avatar}
        </td>
        <td width="40%">Username</td>
        <td width="40%">{username}</td>
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