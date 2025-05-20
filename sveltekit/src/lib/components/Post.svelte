<script>
   export let post;
   //let { post } = $props();
   /*import { writable } from 'svelte/store';
   let dataList = writable([]);
   let errorMessage = writable("");
   async function fetchPosts() {
      try {
         const response = await fetch("http://localhost/api/getallposts.php", {
            credentials: "include"
         });
         const data = await response.json();
         if (data.auth) {
            dataList.set(data.posts);
            console.log("Hämtade inlägg", $dataList);
         } else {
            alert("du är inte inloggad");
         }
      } catch (error) {
         $errorMessage = "Ett fel inträffade vid hämtning av inlägg";
         console.error("API-fel", error);
      }
      console.log("dataList", dataList);
      console.log("dataList.length", dataList.length);
      if(dataList.length > 0){
         console.log("Första inlägget", dataList[0]);
      }
   }
   fetchPosts();*/
</script>

<article>
         <div class="posts">
            <p>{post.post_txt || "Inget innehåll"}</p>
            <small
               >Skapad av: {post.firstname || "Okänd"}
               {post.surname || "okänd"} Tid: {post.date || "Okänd tid"}</small>
         </div>
</article>

<style lang="scss">
   article {
      border-bottom: 1px solid black;
      display: block;
      width: 100%;
      padding: 4px;
      margin-top: 6px;
      margin-bottom: 6px;
      background-color: white;

      .posts{
         margin-bottom: 16px;
         padding: 8px;
         border: 1px solid #ccc;
         border-radius: 4px;
         background-color: #f9f9f9;
      }

      p {
         font-size: 1.6rem;
      }
      small{
         font-size: 1.2rem;
         color: #666;
      }
   }
</style>
