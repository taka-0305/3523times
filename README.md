## サイトのURL
https://3523times.com/

## 概要
鈴木絢音さんと弓木奈於さんに関するニュース記事をまとめるWebサイトです。
![TOPページthumbnail画像](https://github.com/user-attachments/assets/3674a75f-262d-41bb-8fb2-e898781ce225)

## 制作するきっかけ
自分がファンであるお2人のとあるエピソードが公開されたときに、「これどこかで話してたよな…」と思うことがありましたが、なかなかすぐに見つけられず、見つけるまでに時間がかかってしまうことがありました。
そんな経験から、同じような悩みを持つ人もいるのではと考え、ひとつのWebサイトにまとめ、カテゴリ検索やタグ検索を実装することで記事検索を行いやすくしました。

## デザイン
シンプルですっきりとしたデザインとなるよう意識しました。
+ 白系統の落ち着いた配色
+ 余白を持たせ、余裕のあるデザインに

## 挑戦したこと
カテゴリー検索やタグ検索の制作にあたって、SQL文の設定に苦労しました。SQL文の共通部分を変数に格納し、結合することで柔軟性を持たせました。  

```
# /post/lib/get-sql.phpより抜粋
private $data_sql_start = "SELECT m.*,i.image_name,s.source_name";

private $data_sql_main_table = " FROM main m LEFT OUTER JOIN image i ON m.image_id = i.id LEFT OUTER JOIN source s ON m.source_id = s.id";

private $select_category = ",c.category_name";

private $join_category = " LEFT OUTER JOIN category c on m.category_id = c.id";
```
また、オブジェクト指向への理解を深めるため、クラスを作成していますが、まだ完全には理解できていない部分もあります。

## 今後の発展
今後は以下の機能を追加する予定です

+ ワード検索の導入
+ 年月検索の導入
+ オリジナル管理画面

## 主なページ
### TOPページ
![TOPページ画像](https://github.com/user-attachments/assets/8039771f-e6b6-47c9-80ab-d205e341b37e)

### 検索ページ
![検索ページ画像](https://github.com/user-attachments/assets/1c8afe68-f52b-48bf-812d-79985dce4507)

※画像使用については所属事務所に確認し、許可を頂いております。


## 使用技術  
![Static Badge](https://img.shields.io/badge/-HTML5-E34F26?style=flat&logo=html5&logoColor=white)
![Static Badge](https://img.shields.io/badge/-CSS3-1572B6?style=flat&logo=css3&logoColor=white)
![Static Badge](https://img.shields.io/badge/-SASS-CC6699?style=flat&logo=sass&logoColor=white)
![Static Badge](https://img.shields.io/badge/-JavaScript-F7DF1E?style=flat&logo=javascript&logoColor=white)
![Static Badge](https://img.shields.io/badge/-jQuery-0769AD?style=flat&logo=jquery&logoColor=white)
![Static Badge](https://img.shields.io/badge/-PHP-777BB4?style=flat&logo=php&logoColor=white)
![Static Badge](https://img.shields.io/badge/-WordPress-%2321759B?style=flat&logo=wordpress&logoColor=white)
