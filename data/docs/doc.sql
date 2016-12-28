/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50715
Source Host           : localhost:3306
Source Database       : my_test

Target Server Type    : MYSQL
Target Server Version : 50715
File Encoding         : 65001

Date: 2016-12-19 18:00:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `num` int(11) DEFAULT NULL,
  `d_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `homeaddr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES ('1', '1001', '张三', '26', '男', 'beijinghdq');
INSERT INTO `employee` VALUES ('2', '1002', '李四', '24', '女', 'basle');
INSERT INTO `employee` VALUES ('3', '1003', '王五', '25', '男', 'khmnm');
INSERT INTO `employee` VALUES ('4', '1004', '赵六', '15', '男', 'en');
SET FOREIGN_KEY_CHECKS=1;

select * from employee group by d_id,sex;
+-----+------+------+-----+-----+------------+
| num | d_id | name | age | sex | homeaddr   |
+-----+------+------+-----+-----+------------+
|   1 | 1001 | 张三 |  26 | 男  | beijinghdq |
|   2 | 1002 | 李四 |  24 | 女  | basle      |
|   3 | 1003 | 王五 |  25 | 男  | khmnm      |
|   4 | 1004 | 赵六 |  15 | 男  | en         |
+-----+------+------+-----+-----+------------+
4 rows in set

select * from employee group by sex;
+-----+------+------+-----+-----+------------+
| num | d_id | name | age | sex | homeaddr   |
+-----+------+------+-----+-----+------------+
|   2 | 1002 | 李四 |  24 | 女  | basle      |
|   1 | 1001 | 张三 |  26 | 男  | beijinghdq |
+-----+------+------+-----+-----+------------+
2 rows in set

select sex from employee group by sex;
+-----+
| sex |
+-----+
| 女  |
| 男  |
+-----+
2 rows in set

select sex,avg(age) from employee group by sex;
+-----+----------+
| sex | avg(age) |
+-----+----------+
| 女  | 24.0000  |
| 男  | 22.0000  |
+-----+----------+
2 rows in set

select sex,count(sex) from employee group by sex;
+-----+------------+
| sex | count(sex) |
+-----+------------+
| 女  |          1 |
| 男  |          3 |
+-----+------------+
2 rows in set

select sex,count(sex) from employee group by sex having count(sex)>2;
+-----+------------+
| sex | count(sex) |
+-----+------------+
| 男  |          3 |
+-----+------------+
1 row in set

select sex,count(sex) from employee group by sex having count(sex)>2;
+-----+------------+
| sex | count(sex) |
+-----+------------+
| 男  |          3 |
+-----+------------+
1 row in set

select sex,count(sex) from employee group by sex having count(sex)>0;
+-----+------------+
| sex | count(sex) |
+-----+------------+
| 女  |          1 |
| 男  |          3 |
+-----+------------+
2 rows in set

DROP TABLE IF EXISTS `stu`;
CREATE TABLE `stu` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stu
-- ----------------------------
INSERT INTO `stu` VALUES ('1', 'a');
INSERT INTO `stu` VALUES ('2', 'b');
INSERT INTO `stu` VALUES ('3', 'c');
INSERT INTO `stu` VALUES ('4', 'd');
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `exam`;
CREATE TABLE `exam` (
  `id` int(11) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam
-- ----------------------------
INSERT INTO `exam` VALUES ('1', '56');
INSERT INTO `exam` VALUES ('2', '76');
INSERT INTO `exam` VALUES ('11', '98');
SET FOREIGN_KEY_CHECKS=1;

左外连：
select s.name,s.id,e.grade from stu s left join exam e on s.id=e.id;

右外链：
select s.name,s.id,e.grade from stu s right join exam e on s.id=e.id;
