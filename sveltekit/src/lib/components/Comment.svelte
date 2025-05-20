<script>
  //let { comment } = $props();
  export let comment = {};

</script>

<article>
   <div class="comments">
      <p>{comment.comment_txt || "Inget innehåll"}</p>
      <small
         >Skapad av: {comment.firstname || "Okänd"}
         {comment.surname || "okänd"} Tid: {comment.date || "Okänd tid"}</small>
   </div>
</article>

<style>
   article {
      padding: 4px;
      background-color: white;
      margin-top: 5px;
      margin-bottom: 5px;
   }
</style>
