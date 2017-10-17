<?php $city_name = (count($address_info) != 0 ? $address_info[0]['city'] : "" );?>
<?php
$city = array(
            "aveiro" => "Aveiro",
            "lisboa" => "Lisboa",
            "porto" => "Porto",
            "maia" => "Maia",
            "cascais" => "Cascais",
            "seixal" => "Seixal",
            "almada" => "Almada",
            "figueira_da_foz" => "Figueira da Foz",
            "oeiras" => "Oeiras",
            "linda_a_velha" => "Linda-a-Velha",
            "sintra" => "Sintra",
            "odivelas" => "Odivelas"
            );
?>
<div class="col s-9 profile_data">
	<form class="profile-page_update-form" id="form_profile_data" onSubmit="return false;">
		<section class="profile-page_add-form">
			<h1 class="page-title">Dados gerais</h1>
			<div class="form-row hide">
				<div class="form-column">
					<label for="f1">Foto</label>
				</div>
				<div class="form-input clearfix" id="upload-photo">
					<div class="profile-page_profile-image"></div>
					<input id="upload" name="photo" onchange="previewPhoto(this);" type="file" accept="image/jpeg,image/png,image/gif" />
					<label for="upload">Escolha o ficheiro</label>
					<a href="#" class="profile-page_delete" onclick="return removePhoto();">eliminar</a>
					<input id="removePhoto" type="hidden" name="remove_photo" value="false" />
				</div>
			</div>
			<div class="form-input" style="display: none;">
				<input type="text" name="user_id" value="<?php echo $user_info['id']; ?>">
			</div>
			<div class="form-row">
				<div class="form-column">
					<label for="in1">Nome</label>
				</div>
				<div class="form-input">
					<input type="text" id="in1" name="name" autocomplete="off" value="<?php echo $user_info['name']; ?>" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-column">
					<label>E-mail</label>
				</div>
				<div class="form-input">
					<strong><?php echo $user_info['email']; ?></strong>
				</div>
			</div>
			<div class="form-row">
				<div class="form-column">
					<label for="in3">Nova password</label>
				</div>
				<div class="form-input">
					<input type="password" id="in3" autocomplete="off" name="password">
				</div>
			</div>
			<div class="form-row">
				<div class="form-column">
					<label for="in4">Repita a nova password</label>
				</div>
				<div class="form-input">
					<input type="password" id="in4" autocomplete="off" name="passconf">
				</div>
			</div>
		</section>
		<section class="profile-page_add-form">
			<h1 class="page-title">Contactos</h1>
			<div class="form-row">
				<div class="form-column">
					<label for="in5">Telefone</label>
				</div>
				<div class="form-input">
					<?php if(count($phone_info) != 0){ ?>
						<input type="tel" id="in5" name="phone" value="<?php echo $phone_info[0]['number']; ?>" required>
					<?php }else{ ?>
						<input type="tel" id="in5" name="phone" value="" required>
					<?php } ?>
				</div>
			</div>
		</section>
		<section class="profile-page_add-form">
			<h1 class="page-title">Morada</h1>
			<div class="form-row">
				<div class="form-column">
					<label for="mor1">Cidade</label>
				</div>
				<div class="form-input">
					<select name="city">
	                  <?php foreach ($city as $key => $value){ ?>
	                     <?php if($value == $city_name){ ?>
	                        <option value="<?php echo $key; ?>"  name="city" selected><?php echo $value; ?></option>
	                     <?php }else{ ?>
	                        <option value="<?php echo $key; ?>" name="city"><?php echo $value; ?></option>
	                     <?php } ?>
	                  <?php } ?>
	               </select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-column">
					<label for="mor3">Zona</label>
				</div>
				<div class="form-input">
					<select name="zone" class="city_zone_select">
			          <?php foreach ($clean_city_zone as $key => $value){ ?>
			             <?php if($key == $userDetails['id_zone']){ ?>
			                <option value="<?php echo $key; ?>"  name="zone" selected><?php echo $value; ?></option>
			             <?php }else{ ?>
			                <option value="<?php echo $key; ?>" name="zone"><?php echo $value; ?></option>
			             <?php } ?>
			          <?php } ?>
			        </select>
			        <!--
					<?php //if(count($address_info) != 0){ ?>
						<input type="text" id="mor3" name="cod_postal" value="<?php //echo $address_info[0]['cod_postal']; ?>" required>
                    <?php //}else{ ?>
						<input type="text" id="mor3" name="cod_postal" value="" required>
                    <?php //} ?>
                    -->
				</div>
			</div>
			<div class="form-row">
				<div class="form-column">
					<label for="mor2">Rua completa</label>
				</div>
				<div class="form-input">
					<?php if(count($address_info) != 0){ ?>
						<input type="text" id="mor2" name="street" value="<?php echo $address_info[0]['address']; ?>" required>
	                <?php }else{ ?>
						<input type="text" id="mor2" name="street" value="" required>
                    <?php } ?>
				</div>
			</div>
		</section>
		<section class="profile-page_add-form">
			<h1 class="page-title">Notificações</h1>
			<?php if($user_info['notifications']){ ?>
				<input type="checkbox" id="ch2" name="notice_news" value="1" checked>
			<?php }else{ ?>
				<input type="checkbox" id="ch2" name="notice_news" value="1">
			<?php } ?>
			<label for="ch2">Receber as noticias</label>
		</section>
		<section class="profile-page_add-form">
			<h1 class="page-title">Contas sociais</h1>
			<a href="https://www.facebook.com/app_scoped_user_id/1479853302029783/" class="socio-btn socio-btn--facebook">Facebook</a>
			
		</section>
		<button type="reset" class="btn btn--around">cancelar as alterações</button>
		<button type="submit" class="btn btn--green" id="save_profile">guardar as alterações</button>
		<p class="text-center hide save_profile_error_message" style="color: red;">Aconteceu um erro ao guardar os dados, por favor tente mais tarde.</p>

	</form>
</div>