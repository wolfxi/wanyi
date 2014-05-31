<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//Dtd html 4.0 transitional//EN">
<html>
<head>
  <title>无标题页</title>
  <META http-equiv=Content-Type content="text/html; charset=utf-8">
  <style type=text/css> 
{
  FONT-SIZE: 12px
}
#menutree A {
  COLOR: #566984; TEXT-DECORATION: none
}
</style>
  <META content="MShtml 6.00.2900.5848" name=GENERATOR></head>
<body 
style="BACKGROUND-POSITION-Y: -120px; BACKGROUND-IMAGE: url(/wy/Public/Admin/img/bg.gif); BACKGROUND-REPEAT: repeat-x">
  <table height="100%" cellSpacing=0 cellPadding=0 width="100%">
    <tbody>
      <tr>
        <td width=10 height=29>
          <img src="/wy/Public/Admin/img/bg_left_tl.gif"></td>
        <td style="FONT-SIZE: 18px; BACKGROUND-IMAGE: url(/wy/Public/Admin/img/bg_left_tc.gif); COLOR: white; FONT-FAMILY: system">
         <strong>万医</strong> 
        </td>
        <td width=10>
          <img src="/wy/Public/Admin/img/bg_left_tr.gif"></td>
      </tr>
      <tr>
        <td style="BACKGROUND-IMAGE: url(/wy/Public/Admin/img/bg_left_ls.gif)"></td>
        <td id=menutree 
    style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px; HEIGHT: 100%; BACKGROUND-COLOR: white" 
    vAlign=top></td>
        <td style="BACKGROUND-IMAGE: url(/wy/Public/Admin/img/bg_left_rs.gif)"></td>
      </tr>
      <tr>
        <td width=10>
          <img src="/wy/Public/Admin/img/bg_left_bl.gif"></td>
        <td style="BACKGROUND-IMAGE: url(/wy/Public/Admin/img/bg_left_bc.gif)"></td>
        <td width=10>
          <img src="/wy/Public/Admin/img/bg_left_br.gif"></td>
      </tr>
    </tbody>
  </table>
  <script src="/wy/Public/Admin/js/TreeNode.js" type=text/javascript></script>
  <script src="/wy/Public/Admin/js/Tree.js" type=text/javascript></script>
  <script type=text/javascript>
   var img_path="/wy/Public/Admin/img/"; 
   var tree = null;
   var root = new TreeNode('系统菜单');
        //案例管理start
          var fun1 = new TreeNode('案例管理');
          var fun2 = new TreeNode('案例列表', '/wy/Admin/Cases/caselist', 'tree_node.gif', null, 'tree_node.gif', null);
          fun1.add(fun2);
          var fun3 = new TreeNode('添加案例', '/wy/Admin/Cases/caseadd', 'tree_node.gif', null, 'tree_node.gif', null);
          fun1.add(fun3);
          var fun43 = new TreeNode('案例类型', '/wy/Admin/Cases/casetypelist', 'tree_node.gif', null, 'tree_node.gif', null);
          fun1.add(fun43);

          root.add(fun1);
          //案例管理管理end

          //管理员start
          var fun5 = new TreeNode('管理员');
          var fun6 = new TreeNode('我的信息', '/wy/Admin/Admin/index', 'tree_node.gif', null, 'tree_node.gif', null);
          fun5.add(fun6);
          var fun51 = new TreeNode('修改信息', '/wy/Admin/Admin/adminmodify', 'tree_node.gif', null, 'tree_node.gif', null);
          fun5.add(fun51);
          var fun52 = new TreeNode('修改密码', '/wy/Admin/Admin/passwordui', 'tree_node.gif', null, 'tree_node.gif', null);
          fun5.add(fun52);
          root.add(fun5);
          //管理员end

          //留言管理start
          var fun9 = new TreeNode('留言管理');
          var fun10 = new TreeNode('留言列表', '/wy/Admin/Leavemessage/showmessage', 'tree_node.gif', null, 'tree_node.gif', null);
          fun9.add(fun10);
          root.add(fun9);
          //留言管理end

          //相册管理start
          var fun11 = new TreeNode('图片管理');
          var fun12 = new TreeNode('案例相册', '/wy/Admin/Album/casealbum', 'tree_node.gif', null, 'tree_node.gif', null);
          fun11.add(fun12);
          var fun13 = new TreeNode('人员相册', '/wy/Admin/Album/personalbum', 'tree_node.gif', null, 'tree_node.gif', null);
          fun11.add(fun13);
          var fun14= new TreeNode('工作室相册', '/wy/Admin/Album/smartalbum', 'tree_node.gif', null, 'tree_node.gif', null);
          fun11.add(fun14);
          var fun141= new TreeNode('添加图片类型', '/wy/Admin/Album/addalbumtypeui', 'tree_node.gif', null, 'tree_node.gif', null);
          fun11.add(fun141);
          root.add(fun11);
          //相册管理end












          //公司信息start
          var fun15 = new TreeNode('公司信息');
          var fun16 = new TreeNode('动态列表', '/wy/Admin/Company/announcementlist', 'tree_node.gif', null, 'tree_node.gif', null);
          fun15.add(fun16);
          var fun161 = new TreeNode('添加动态', '/wy/Admin/Company/add_announcementui', 'tree_node.gif', null, 'tree_node.gif', null);
          fun15.add(fun161);
          var fun17 = new TreeNode('联系方式', '/wy/Admin/Company/companyinfo', 'tree_node.gif', null, 'tree_node.gif', null);
          fun15.add(fun17);
          var fun151 = new TreeNode('公司介绍', '/wy/Admin/Company/companyintroduceui', 'tree_node.gif', null, 'tree_node.gif', null);
          fun15.add(fun151);
          var fun18 = new TreeNode('招聘信息', '/wy/Admin/Company/companyjob', 'tree_node.gif', null, 'tree_node.gif', null);
           fun15.add(fun18);
           var fun181 = new TreeNode('添加招聘', '/wy/Admin/Company/add_jobui', 'tree_node.gif', null, 'tree_node.gif', null);
           fun15.add(fun181);
            var fun19 = new TreeNode('友情链接', '/wy/Admin/Company/companylink', 'tree_node.gif', null, 'tree_node.gif', null);
          fun15.add(fun19);
          root.add(fun15);
          //公司信息end



















          Tree = new Tree(root);
          Tree.show('menutree');
</script>
</body>
</html>