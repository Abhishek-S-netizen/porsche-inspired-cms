@if (session("success")) 
    <div id="flash-banner">
        {{ session("success") }}
    </div>
@endif