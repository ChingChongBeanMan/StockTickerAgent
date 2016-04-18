<div class="row">
     <div class="col-md-12">
         <table class="CSSTableGenerator table">
            <thead>
            <td>Name</td>
            <td></td>
            <td></td>
            </thead>
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
