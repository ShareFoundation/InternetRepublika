SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE `badge`
  ADD CONSTRAINT `badge_FK_1` FOREIGN KEY (`type_id`) REFERENCES `badge_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `comment`
  ADD CONSTRAINT `comment_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_FK_2` FOREIGN KEY (`parent_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `inappropriate`
  ADD CONSTRAINT `inappropriate_FK_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inappropriate_FK_2` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `inappropriate_comment`
  ADD CONSTRAINT `inappropriate_comment_FK_1` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inappropriate_comment_FK_2` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `partie`
  ADD CONSTRAINT `partie_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `partie_custom_points`
  ADD CONSTRAINT `partie_custom_points_FK_1` FOREIGN KEY (`partie_id`) REFERENCES `partie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partie_custom_points_FK_2` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `partie_daily_stats`
  ADD CONSTRAINT `partie_daily_stats_FK_1` FOREIGN KEY (`partie_id`) REFERENCES `partie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `partie_index`
  ADD CONSTRAINT `partie_index_FK_1` FOREIGN KEY (`partie_id`) REFERENCES `partie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `partie_visits`
  ADD CONSTRAINT `partie_visits_FK_1` FOREIGN KEY (`partie_id`) REFERENCES `partie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partie_visits_FK_2` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `post`
  ADD CONSTRAINT `post_FK_1` FOREIGN KEY (`partie_id`) REFERENCES `partie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_FK_2` FOREIGN KEY (`replica_post_id`) REFERENCES `post` (`id`) ON UPDATE CASCADE;

ALTER TABLE `post_badge`
  ADD CONSTRAINT `post_badge_FK_1` FOREIGN KEY (`badge_id`) REFERENCES `badge` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_badge_FK_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_badge_FK_3` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_badge_FK_4` FOREIGN KEY (`type_id`) REFERENCES `badge_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `post_daily_stats`
  ADD CONSTRAINT `post_daily_stats_FK_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `post_index`
  ADD CONSTRAINT `post_index_FK_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `post_poll_answer`
  ADD CONSTRAINT `post_poll_answer_FK_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `post_poll_vote`
  ADD CONSTRAINT `post_poll_vote_FK_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_poll_vote_FK_2` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_poll_vote_FK_3` FOREIGN KEY (`answer_id`) REFERENCES `post_poll_answer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `post_visits`
  ADD CONSTRAINT `post_visits_FK_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_visits_FK_2` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `sf_guard_group_permission`
  ADD CONSTRAINT `sf_guard_group_permission_FK_1` FOREIGN KEY (`group_id`) REFERENCES `sf_guard_group` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sf_guard_group_permission_FK_2` FOREIGN KEY (`permission_id`) REFERENCES `sf_guard_permission` (`id`) ON DELETE CASCADE;

ALTER TABLE `sf_guard_remember_key`
  ADD CONSTRAINT `sf_guard_remember_key_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE;

ALTER TABLE `sf_guard_user_group`
  ADD CONSTRAINT `sf_guard_user_group_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sf_guard_user_group_FK_2` FOREIGN KEY (`group_id`) REFERENCES `sf_guard_group` (`id`) ON DELETE CASCADE;

ALTER TABLE `sf_guard_user_permission`
  ADD CONSTRAINT `sf_guard_user_permission_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sf_guard_user_permission_FK_2` FOREIGN KEY (`permission_id`) REFERENCES `sf_guard_permission` (`id`) ON DELETE CASCADE;

ALTER TABLE `sf_guard_user_profile`
  ADD CONSTRAINT `sf_guard_user_profile_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `sf_tagging`
  ADD CONSTRAINT `sf_tagging_FK_1` FOREIGN KEY (`tag_id`) REFERENCES `sf_tag` (`id`) ON DELETE CASCADE;

SET FOREIGN_KEY_CHECKS=1;