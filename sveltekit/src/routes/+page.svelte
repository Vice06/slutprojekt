<script>
   import Load from "$lib/components/Load.svelte";
   import PostForm from "$lib/components/PostForm.svelte";
   import Post from "$lib/components/Post.svelte";
   import CommentForm from "$lib/components/CommentForm.svelte";
   import Comment from "$lib/components/Comment.svelte";

   import { user } from "$lib/stores/user.svelte.js";
   import { goto, afterNavigate } from "$app/navigation";
   import { auth } from "$lib/shared/auth.js";
   import { update } from "$lib/stores/update.svelte.js";
   import { writable } from "svelte/store";

   afterNavigate(async () => {
      const response = await auth();
      user.auth = response.auth;
      user.userdata = response.userdata;

      if (!user.auth) {
         goto("/login");
      }
   });

   // Funktion för att hämta inlägg
   let dataList = writable([]);
   async function fetchPosts() {
      try {
         const response = await fetch("http://localhost/api/getallposts.php", {
            credentials: "include",
         });
         const data = await response.json();
         if (data.auth) {
            dataList.set(data.posts); // Uppdatera inläggslistan
         }
      } catch (error) {
         console.error("Ett fel inträffade vid hämtning av inlägg:", error);
      }
   }

   $: if ($update) {
      fetchPosts();
      update.set(false);
   }

   fetchPosts();
</script>

<PostForm />

<section>
   <!-- Rendera flödet för alla användare -->
   {#if $dataList.length > 0}
      {#each $dataList as post}
         <div class="post-container">
            <Post {post} />
            <CommentForm postID={post.pid} />
            <!-- Lägg till CommentForm under varje post -->
         </div>
         <!--Lägga till kommentarerna-->
         {#if post.comment && post.comment.length > 0}
            {#each post.comment as comment}
               <div class="comments">
                  <Comment {comment} />
               </div>
            {/each}
         {:else}
            <p>Inga kommentarer ännu</p>
         {/if}
      {/each}
   {:else}
      <p>laddar inlägg</p>
   {/if}
</section>

<style lang="scss">
   section {
      max-width: 540px;

      hr {
         margin-bottom: 16px;
         margin-top: 8px;
      }

      .comments {
         border-left: 2px solid green;
         padding-left: 4px;
      }
   }
</style>
