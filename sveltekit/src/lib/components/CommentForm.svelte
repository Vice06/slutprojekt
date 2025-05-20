<script>
   import { update } from "$lib/stores/update.svelte.js";
   export let postID;

   // Ev egen kod!

   //let { postID } = $props();

   async function addComment(e) {
      e.preventDefault();
      const formData = new FormData(e.target);
      //skapa ett objekt från formulärdata
      const data = { commentTxt: formData.get("commentTxt"), 
      pid: postID
      };
      console.log(data);
      try {
         const response = await fetch("http://localhost/api/addcomment.php", {
            method: "POST",
            headers: {
               "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
         });
         //hantera svaret
         const responseData = await response.json();
         console.log("Svar från api", responseData);
         if (responseData.success) {
            alert("Lyckades kommentera inlägg");
            update.set(true);
         } else {
            alert("Något gick fel.");
         }
      } catch (error) {
         console.error("Ett fel inträffade:", error);
         alert(
            "Ett fel inträffade. Kontrollera din anslutning och försök igen",
         );
      }
   }
   
</script>

<form on:submit={addComment}>
      <input type="text" name="commentTxt" id="commentTxt" placeholder="Skriv en kommentar">
      <button type="submit">Kommentera</button>
</form>

<style lang="scss">
   form {
      display: flex;
      flex-direction: row;

      width: 100%;

      input[type='text'] {
         width: 100%;
      }

      button{
         border: none;
         border-radius: 4px;
         padding: 5px 15px;
         text-decoration: none;
         color: white;
         background-color: #42b72a;
         margin-left: 2px;  
         flex-grow: 0;
         &:hover {
            background-color: darkgreen;
            color: #ffffff;
         }
      }
   }
</style>
