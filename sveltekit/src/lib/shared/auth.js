/**
 * Kontroll om man är inloggad eller ej.
 * 
 * @returns "auth": true/false,"userdata": {"uid": ..., "firstname": ..., "surname": ...}
 */
export async function auth() {
   let result = {"auth": false, "userdata": null};

   try {
      const response = await fetch("http://localhost/api/auth.php");
      result = await response.json();
   } catch (e) {}

   return result;
}