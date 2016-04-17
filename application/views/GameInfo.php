<div>
    <div class="text-center col-md-12">
        <table class="CSSTableGenerator table table-hover">
            {temptitle}
            <tr>
                <th>Round</th>
                <th>State</th>
                <th>Desc</th>
                <th>Duration</th>
                <th>Upcomming</th>
                <th>Alarm</th>
                <th>Now</th>
                <th>Countdown</th>
            </tr>
            {information}
            <tr>
                <td>{round}</td>
                <td>{state}</td>
                <td>{desc}</td>
                <td>{duration}</td>
                <td>{upcoming}</td>
                <td>{alarm}</td>
                <td>{now}</td>
                <td>{countdown}</td>
            </tr>
            {/information}
        </table>
    </div>
    
    
    <div class="text-center col-md-12 ">
    <table class="CSSTableGenerator table table-hover">
            {temp2title}
            <tr>
                <th>code</th>
                <th>name</th>
                <th>category</th>
                <th>value</th>
            </tr>
            {stockInfo}
            <tr>
                <td>{code}</td>
                <td>{name}</td>
                <td>{category}</td>
                <td>{value}</td>
            </tr>
            {/stockInfo}
        </table>
    </div>
    
</div>
