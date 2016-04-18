<div class="row">
     <div class="col-md-12">
         <table class="CSSTableGenerator table">
            <tr>
                <td colspan="3"><h4><b>User List</b></h4></td>

            </tr>
            {listPlayer}
            <tr>
                <td>{username}</td>
                <td><a href="/Admin/edit/{username}">Edit</a></td>
                <td><a href="/Admin/delete/{username}">Delete</a></td>
            </tr>
            {/listPlayer}
        </table>
    </div>
</div>
