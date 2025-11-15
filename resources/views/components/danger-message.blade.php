@props(["msg","color"=>"#ff0000"])

<div id="task-failed" style="border-color:{{$color}}">
   <p class="danger-msg" style="color: {{$color}}">{{$msg}}</p> <p id="close-button">x</p>
</div>

<style>
#task-failed{
 
    display: flex;
    justify-content: space-between;
    gap:16px;
  border: 1px solid #ff0000; 
  padding: 4px 12px;

}
#task-failed .danger-msg{
    color: #ff0000;
}

#close-button{
    cursor: pointer;
    font-size: 17px;
}
</style>

<script>
       const closeButton = document.getElementById("close-button");
        const dangerMessage=document.getElementById("task-failed");
        closeButton.addEventListener("click", function() {
            // Your code here, e.g.:
            dangerMessage.style.display="none";
            
        });


</script>