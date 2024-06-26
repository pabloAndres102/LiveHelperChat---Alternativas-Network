<style>
  .tarjeta {
    border: 1px solid #ddd;
    border-radius: 12px; /* Rounded corners */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Softer shadow */
    padding: 20px;
    text-align: center;
    width: 400px;
    margin: 20px auto; /* Centered horizontally and with some vertical margin */
    background-color: #fff; /* White background */
    transition: transform 0.3s ease; /* Smooth transform transition */
  }

  .tarjeta:hover {
    transform: translateY(-5px); /* Lift effect on hover */
  }

  .tarjeta input[type="text"],
  .tarjeta input[type="submit"],
  .tarjeta select,
  .tarjeta input[type="color"] {
    width: calc(100% - 22px); /* Adjusted width for consistent padding */
    padding: 10px;
    margin: 10px 0; /* Increased margin for better spacing */
    border: 1px solid #ccc;
    border-radius: 8px; /* Rounded corners */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1); /* Inner shadow */
    transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for focus */
  }

  .tarjeta input[type="text"]:focus,
  .tarjeta select:focus,
  .tarjeta input[type="color"]:focus {
    border-color: #007bff; /* Border color on focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Outer shadow on focus */
  }

  .tarjeta label {
    text-align: left;
    display: block;
    margin-bottom: 5px;
    font-weight: bold; /* Bold labels */
    color: #333; /* Darker text color */
  }

  .tarjeta .btn {
    width: 100%; /* Full width button */
    padding: 12px; /* Larger padding for button */
    border: none;
    border-radius: 8px; /* Rounded corners */
    cursor: pointer;
    font-size: 1rem; /* Larger font size */
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    background-color: #ffc107; /* Warning button color */
    color: #212529; /* Dark text color */
    transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition for hover */
  }

  .tarjeta .btn:hover {
    background-color: #e0a800; /* Darker yellow on hover */
    transform: translateY(-2px); /* Slight lift effect on hover */
  }

  .tarjeta .btn .material-icons {
    font-size: 1.2rem; /* Adjust icon size */
  }
</style>

<div class="tarjeta">
    <form method="POST" action="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/kanban_edit') ?>">
        <label for="nombre"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Name'); ?></label>
        <input type="text" id="name_status" name="name_status" value="<?php print_r($status->nombre) ?>" required><br>
        <label for="color">Color</label>
        <input type="hidden" id="status_edit" name="status_edit" value="<?php echo $_GET['status_id']; ?>"><br>
        <input type="color" id="color" name="color" value="<?php print_r($status->color); ?>"><br>
        <button type="submit" class="btn btn-warning"><span class="material-icons">edit</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Edit'); ?></button>
    </form>
</div>