# Comportements observables (User Stories)

- **Story 1** :
>**Given** I'm a new user <br>
**When** I can create a account<br>
**Then** I can access the application's functionalities

- **Story 2** :
>**Given**  I'm logged in <br>
**When** I can create a group <br>
**Then** the group is add in my groups list <br>
**And** I have an invitation code

- **Story 3** :
>**Given** I'm logged in  <br>
**And** I have a valid invitation code<br>
**When** I enter the invitation code<br>
**Then** I become a member of the group <br>
**And** I can access the shared inventory

- **Story 4** :
>**Given** I'm logged in <br>
**When** I add a new item<br>
**Then** The item is added to my personnal inventory<br>
**And** the item is not shared with any group

- **Story 5** :
>**Given** I own an item <br>
**And** I belong in at least one group<br>
**When** I select the group(s) that can access the item<br>
**Then** The item is visible in the intentory of the group(s) selected