<?php
    error_reporting(0);
    //演示数据
    $catalogue  =   array(
      0=>array(
        'id'=>1,
        'title'=>'php',
      ),
      1=>array(
        'id'=>2,
        'title'=>'jquery'
      ),
      2=>array(
        'id'=>3,
        'title'=>'javascript'
      ),
    );
    $articles=array(
      0=>array(
          'id'=>1,
          'title'=>'测试文章一',
          'cattitle'=>'php',
          'posttime'=>'2010/08/01',
          'commend'=>0
      ),
      1=>array(
          'id'=>2,
          'title'=>'测试文章二',
          'cattitle'=>'php',
          'posttime'=>'2010/08/01',
          'commend'=>0
      ),
      2=>array(
          'id'=>3,
          'title'=>'测试文章三',
          'cattitle'=>'php',
          'posttime'=>'2010/08/01',
          'commend'=>0,
          'locked'=>0,
          'actived'=>1
      ),
      3=>array(
          'id'=>4,
          'title'=>'测试文章四',
          'cattitle'=>'php',
          'posttime'=>'2010/08/01',
          'commend'=>0,
          'locked'=>0,
          'actived'=>1
      ),
      4=>array(
          'id'=>5,
          'title'=>'测试文章五',
          'cattitle'=>'php',
          'posttime'=>'2010/08/01',
          'commend'=>0,
          'locked'=>0,
          'actived'=>1
      ),
      5=>array(
          'id'=>6,
          'title'=>'测试文章六',
          'cattitle'=>'php',
          'posttime'=>'2010/08/01',
          'commend'=>0,
          'locked'=>0,
          'actived'=>1
      ),
      6=>array(
          'id'=>7,
          'title'=>'测试文章七',
          'cattitle'=>'php',
          'posttime'=>'2010/08/01',
          'commend'=>0,
          'locked'=>0,
          'actived'=>1
      ),
      7=>array(
          'id'=>8,
          'title'=>'测试文章八',
          'cattitle'=>'php',
          'posttime'=>'2010/08/01',
          'commend'=>0,
          'locked'=>0,
          'actived'=>1
      ),
      8=>array(
          'id'=>9,
          'title'=>'测试文章九',
          'cattitle'=>'php',
          'posttime'=>'2010/08/01',
          'commend'=>0,
          'locked'=>0,
          'actived'=>1
      ),
      9=>array(
          'id'=>10,
          'title'=>'测试文章十',
          'cattitle'=>'php',
          'posttime'=>'2010/08/01',
          'commend'=>0,
          'locked'=>0,
          'actived'=>1
      ),
);
?>

<script type="text/javascript">
$(function(){
    //删除确认
    $('.ui-icon-trash').bind('click',function(){
        if(confirm('确定要删除'+$(this).attr('articletitle')+'吗？')){
            alert($(this).attr('articletitle')+'删除成功');
        }
    });
   bindModify();
   bindCommended();
   bindUncommended();
   bindUnlocked();
   bindLocked();
   bindActived();
   bindUnactived();
});
function bindModify(){
    $('.ui-icon-wrench').bind('click',function(){
       url='articleedit.php?id='+$(this).attr('articleid');
       tabName=$(this).attr('articletitle');
       $('#sl-tabs').tabs('add',url,tabName);
       newIndex=$('#sl-tabs').tabs('length')-1;
       $('#sl-tabs').tabs('select',newIndex);
    });
}
function bindCommended(){
    $('.ui-icon-pin-s').bind('click',function(){
        $(this).removeClass('ui-icon-pin-s');
        $(this).addClass('ui-icon-pin-w');
        $(this).attr('title','未推荐');
        bindUncommended();
    });
}
function bindUncommended(){
    $('.ui-icon-pin-w').bind('click',function(){
        $(this).removeClass('ui-icon-pin-w');
        $(this).addClass('ui-icon-pin-s');
        $(this).attr('title','已推荐');
        bindCommended();
    });
}
function bindUnlocked(){
    $('.ui-icon-unlocked').bind('click',function(){
        $(this).removeClass('ui-icon-unlocked');
        $(this).addClass('ui-icon-locked');
        $(this).attr('title','已锁定');
        bindLocked();
    });
}
function bindLocked(){
    $('.ui-icon-locked').bind('click',function(){
        $(this).removeClass('ui-icon-locked');
        $(this).addClass('ui-icon-unlocked');
        $(this).attr('title','未锁定');
        bindUnlocked();
    });
}
function bindActived(){
    $('.ui-icon-check').bind('click',function(){
        $(this).removeClass('ui-icon-check');
        $(this).addClass('ui-icon-cancel');
        $(this).attr('title','未发布');
        bindUnactived();
    });
}
function bindUnactived(){
    $('.ui-icon-cancel').bind('click',function(){
        $(this).removeClass('ui-icon-cancel');
        $(this).addClass('ui-icon-check');
        $(this).attr('title','已发布');
        bindActived();
    });
}
</script>
<fieldset>
    <legend>搜索文章</legend>
    <form id="form-searcharticles" name="form-searcharticles" method="POST" action="usersmanage.php">
    <ul class="sl-table">
        <li><label>文章分类</label>
            <select name="catalogue">
                <option value="0">不限分类</option>
                <?php foreach($catalogue as $class){?>
                <option value="<?=$class['id']?>"><?=$class['title']?></option>
                <?php }?>
            </select>
        </li>
        <li><label>标题中包含关键字</label><input type="text" name="title"></li>
        <li><label>发布时间</label><input type="text" id="postStart" name="postStart" />之后，<input type="text" id="postEnd" name="postEnd"/>之前</li>
        <li><label>文章状态</label><input type="checkbox" name="commend" value="1">已推荐 <input type="checkbox" name="locked" value="1">已锁定 <input type="checkbox" name="actived" value="0">未发布</li>
        <li class="footer"><label>&nbsp;</label><input type="submit" name="submit" value="搜索"></li>
    </ul>
</form>
</fieldset>
<br/>
<div class="ui-state-highlight">
<p><span class="ui-icon ui-icon-info"></span>
所有文章</p>
</div>
<fieldset>
<legend>文章发布</legend>
    <table class="sl-table">
        <thead>
        <tr><td>标题</td><td>分类</td><td>发布时间</td><td>操作</td></tr>
        </thead>
        <tbody>
        <?php
            foreach($articles as $article){
               $action="<span articleid=$article[id] articletitle=$article[title] class='ui-icon ui-icon-trash' title='删除'></span><span articleid=$article[id] articletitle=$article[title] title='修改' class='ui-icon ui-icon-wrench'></span>";
               if($article['commended']){
                   $action.='<span title="已推荐" class="ui-icon ui-icon-pin-s"></span>';
               }else{
                   $action.='<span title="未推荐" class="ui-icon ui-icon-pin-w"></span>';
               }
               if($article['locked']){
                   $action.='<span title="已锁定" class="ui-icon ui-icon-locked"></span>';
               }else{
                   $action.='<span title="未锁定" class="ui-icon ui-icon-unlocked"></span>';
               }
               if($article['actived']){
                   $action.='<span title="已发布" class="ui-icon ui-icon-check"></span>';
               }else{
                   $action.='<span title="未发布" class="ui-icon ui-icon-cancel"></span>';
               }
               echo "<tr><td>$article[title]</td><td>$article[cattitle]</td><td>$article[posttime]</td><td>$action</td></tr>";
            }
        ?>
        </tbody>
    </table>
    <span class="pagefooter"><a href="#">首页</a><a href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">6</a><a href="#">7</a><a href="#">8</a><a href="#">9</a><a href="#">10</a>...<a href="#">尾页</a></span>
</fieldset>