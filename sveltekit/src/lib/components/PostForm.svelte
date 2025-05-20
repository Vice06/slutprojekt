<script>
   import { update } from "$lib/stores/update.svelte.js";

   // Ev egen kod!

   async function addPost(e) {
      e.preventDefault();
      const formData = new FormData(e.target);
      //skapa ett objekt från formulärdata
      const data = { postTxt: formData.get("postTxt") };
      try {
         const response = await fetch("http://localhost/api/addpost.php", {
            method: "POST",
            headers: {
               "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
         });
         //hantera svaret
         const responseData = await response.json();
         if (responseData.success) {
            alert("Lyckades posta inlägg");
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
<h1>Twitterkopia</h1>
<h2>Posta en ny tråd</h2>
<form on:submit={addPost}>
   <textarea name="postTxt" id="postTxt" placeholder="Skriv ett inlägg"></textarea>
   <button type="submit">Lägg ut inlägg</button>
</form>

<style lang="scss">
   form {
      text-align: right;
      max-width: 540px;

      textarea {
         width: 100%;
         height: 10rem;
         vertical-align: top;
         border: 1px solid rgb(124, 10, 10);
         border-radius: 6px;
         resize: none;
         padding: 0.5rem;
      }

      p {
         display: inline-block;
         color: red;
         font-weight: bold;
         margin-right: 1rem;
      }

      button {
         border: none;
         border-radius: 4px;
         padding: 5px 15px;
         text-decoration: none;
         color: white;
         background-color: #42b72a;
         margin-top: 0.2rem;

         &:enabled:hover {
            background-color: green;
            color: #ffffff;
         }

         &:enabled:active {
            background-color: rgb(4, 50, 4);
            color: #aeaeae;
         }

         &:disabled {
            background-color: lightgrey;
         }
      }
   }
</style>
