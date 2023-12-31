@php
    $setMenit = DB::table('tb_menit')
        ->where('id_lokasi', $lokasi)
        ->first();
@endphp
<?php foreach ($menu as $m) : if($m->nm_menu == ''){continue;} ?>
<tr class="header">
    <td></td>
    <td style="white-space:nowrap;text-transform: lowercase;">
        <?= $m->nm_menu ?>
        <span class="text-danger">({{ $m->ttlMenuSemua }})</span>
    </td>
    <td>
        <?= $m->request ?>
    </td>
    <td>
        <?= $m->qty ?>
    </td>
    <?php if ($m->selesai == 'dimasak') : ?>
    <?php if ($m->id_koki1 != '0') : ?>
    <td><a kode="<?= $m->id_order ?>" class="btn btn-info btn-sm selesai" id_meja="{{ $m->id_meja }}"><i
                class="fas fa-thumbs-up"></i></a>
    </td>
    <?php else : ?>
    <!-- <td><a kode="<?= $m->id_order ?>" class="btn btn-info btn-sm gagal"><i class="fas fa-thumbs-up"></i></a></td> -->
    <td></td>
    <?php endif ?>
    <?php foreach ($tb_koki as $k) : ?>
    <?php if ($m->id_koki1 != '0') : ?>
    <?php if ($m->id_koki1 == $k->id_karyawan) : ?>
    <td><a kode="<?= $m->id_order ?>" class="btn btn-warning btn-sm un_koki1" id_meja="{{ $m->id_meja }}"><i
                class="fas fa-minus"></i></a>
    </td>
    <?php else : ?>
    <?php if ($m->id_koki2 != '0') : ?>
    <?php if ($m->id_koki2 == $k->id_karyawan) : ?>
    <td><a kode="<?= $m->id_order ?>" class="btn btn-sm btn-warning un_koki2" id_meja="{{ $m->id_meja }}"><i
                class="fas fa-grip-lines"></i></a></td>
    <?php else : ?>
    <?php if ($m->id_koki3 != '0') : ?>
    <td><a kode="<?= $m->id_order ?>" class="btn btn-sm btn-warning un_koki3" id_meja="{{ $m->id_meja }}"><i
                class="fas fa-bars"></i></a>
    </td>
    <?php else : ?>
    <td><a kode="<?= $m->id_order ?>" kry="<?= $k->id_karyawan ?>" id_meja="{{ $m->id_meja }}"
            class="btn btn-sm btn-success koki3"><i class="fas fa-users"></i></a></td>
    <?php endif ?>
    <?php endif ?>

    <?php else : ?>
    <td><a kode="<?= $m->id_order ?>" kry="<?= $k->id_karyawan ?>" id_meja="{{ $m->id_meja }}"
            class="btn btn-sm btn-success koki2"><i class="fas fa-user-friends"></i></a></td>
    <?php endif ?>
    <?php endif ?>
    <?php else : ?>
    <td>
        <a kode="<?= $m->id_order ?>" kry="<?= $k->id_karyawan ?>" id_meja="{{ $m->id_meja }}"
            class="btn btn-sm btn-success koki1"><i class="fas fa-check"></i></a>
    </td>
    <?php endif ?>
    <?php endforeach ?>
    <td style="font-weight: bold;">
        <?= date('H:i', strtotime($m->j_mulai)) ?>
    </td>
    <?php else : ?>
    <td style="text-decoration: line-through; "><a href="<?= base_url("orderan/order/$m->no_order") ?>"
            style="color:black;">SELESAI</a></td>
    <?php foreach ($tb_koki as $k) : ?>
    <td></td>
    <?php endforeach ?>
    <?php if (date('H:i', strtotime($m->j_selesai)) < date('H:i', strtotime($m->j_mulai . '+'.$setMenit->menit.'minutes'))) : ?>
    <td><b style="color:blue;">
            <?= date('H:i', strtotime($m->j_selesai)) ?>
        </b></td>
    <?php else : ?>
    <td><b style="color:red;">
            <?= date('H:i', strtotime($m->j_selesai)) ?>
        </b></td>
    <?php endif ?>
    <?php endif ?>
</tr>
<?php endforeach ?>
</tr>
