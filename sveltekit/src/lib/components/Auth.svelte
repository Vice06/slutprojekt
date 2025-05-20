<script>
   import { user } from "$lib/stores/user.svelte.js";
   import { goto } from "$app/navigation";

   // Ev egen kod!

   async function signIn(e) {
      e.preventDefault();
      const formData = new FormData(e.target);
      const data = {
         user: formData.get("user"),
         pwd: formData.get("pwd")
      };

      try {
         const response = await fetch("http://localhost/api/auth.php", {
            method: "POST",
            headers: {
               "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
         });

         //hantera svaret
         const responseData = await response.json();
         if (responseData.auth) {
            goto("/");
         } else {
            alert("Kunde inte logga in. Försök igen.");
         }
         console.log(responseData);
      } catch (error) {
         console.error("Ett fel inträffade:", error);
         alert(
            "Ett fel inträffade. Kontrollera din anslutning och försök igen",
            
         );
      }
   }


</script>


<form onsubmit={signIn}> <!--bind:this={form}-->
   <!-- Egen kod! -->
   <label for="user">Användarnamn</label>
   <input id="user" type="text" name="user" />

   <label for="pwd">Lösenord</label>
   <input id="pwd" type="password" name="pwd" />

   <input type="submit" value="Logga In" />
</form>
   

<style lang="scss">
   label {
      display: block;
   }

   input {
      width: 100%;

      &.red {
         background-color: rgb(247, 129, 129);
      }

      &[type="submit"] {
         color: white;
         background-color: #42b72a;
         border: none;
         margin: 10px 10px 0 0;
         padding: 0.7rem;
         border-radius: 6px;

         &:hover {
            background-color: green;
         }
      }
   }
</style>
