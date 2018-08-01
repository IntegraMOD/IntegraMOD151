START TRANSACTION;

#
# ADR
#

# Alignments
INSERT INTO phpbb_adr_alignments (alignment_id, alignment_name, alignment_desc, alignment_level, alignment_img, alignment_karma_min, alignment_karma_type) VALUES (1, 'Adr_alignment_neutral', 'Adr_alignment_neutral_desc', 0, 'Neutral.gif', 0, 0);
INSERT INTO phpbb_adr_alignments (alignment_id, alignment_name, alignment_desc, alignment_level, alignment_img, alignment_karma_min, alignment_karma_type) VALUES (2, 'Adr_alignment_evil', 'Adr_alignment_evil_desc', 0, 'Evil.gif', 1000, 2);
INSERT INTO phpbb_adr_alignments (alignment_id, alignment_name, alignment_desc, alignment_level, alignment_img, alignment_karma_min, alignment_karma_type) VALUES (3, 'Adr_alignment_good', 'Adr_alignment_good_desc', 0, 'Good.gif', 1000, 1);

# Monsters
INSERT INTO phpbb_adr_battle_monsters (monster_id, monster_name, monster_img, monster_level, monster_base_hp, monster_base_att, monster_base_def, monster_base_mp, monster_base_custom_spell, monster_base_magic_attack, monster_base_magic_resistance, monster_base_mp_power, monster_base_sp, monster_thief_skill, monster_base_element, monster_base_karma, monster_season, monster_weather, monster_message_enable, monster_message) VALUES (1338, 'torch eye', 'torch eye.gif', 1, 12, 24, 25, 1, 'a magical spell', 7, 9, 1, 3, 21, 6, 0, 0, '0', 0, '');

# Classes
INSERT INTO phpbb_adr_classes (class_id, class_name, class_desc, class_level, class_img, class_might_req, class_dexterity_req, class_constitution_req, class_intelligence_req, class_wisdom_req, class_charisma_req, class_base_hp, class_base_mp, class_base_ac, class_update_hp, class_update_mp, class_update_ac, class_update_xp_req, class_update_of, class_update_of_req, class_selectable, class_magic_attack_req, class_magic_resistance_req) VALUES (1, 'Anti Paladin', 'Defeats Paladins', 0, 'Anti Paladin.gif', 0, 0, 0, 0, 0, 0, 12, 1, 10, 12, 2, 1, 2000, 0, 0, 1, 0, 0);

# Elements 
INSERT INTO phpbb_adr_elements (element_id, element_name, element_desc, element_level, element_img, element_skill_mining_bonus, element_skill_stone_bonus, element_skill_forge_bonus, element_skill_enchantment_bonus, element_skill_trading_bonus, element_skill_thief_bonus, element_oppose_strong, element_oppose_strong_dmg, element_oppose_same_dmg, element_oppose_weak, element_oppose_weak_dmg) VALUES (1, 'Adr_element_water', 'Adr_element_water_desc', 0, 'Water.gif', 10, 10, 10, 10, 30, 30, 4, 100, 100, 4, 100);
INSERT INTO phpbb_adr_elements (element_id, element_name, element_desc, element_level, element_img, element_skill_mining_bonus, element_skill_stone_bonus, element_skill_forge_bonus, element_skill_enchantment_bonus, element_skill_trading_bonus, element_skill_thief_bonus, element_oppose_strong, element_oppose_strong_dmg, element_oppose_same_dmg, element_oppose_weak, element_oppose_weak_dmg) VALUES (2, 'Adr_element_earth', 'Adr_element_earth_desc', 0, 'Earth.gif', 30, 30, 10, 10, 10, 10, 6, 100, 100, 6, 100);
INSERT INTO phpbb_adr_elements (element_id, element_name, element_desc, element_level, element_img, element_skill_mining_bonus, element_skill_stone_bonus, element_skill_forge_bonus, element_skill_enchantment_bonus, element_skill_trading_bonus, element_skill_thief_bonus, element_oppose_strong, element_oppose_strong_dmg, element_oppose_same_dmg, element_oppose_weak, element_oppose_weak_dmg) VALUES (3, 'Adr_element_holy', 'Adr_element_holy_desc', 2, 'Holy.gif', 20, 20, 20, 20, 20, 20, 7, 100, 100, 7, 100);
INSERT INTO phpbb_adr_elements (element_id, element_name, element_desc, element_level, element_img, element_skill_mining_bonus, element_skill_stone_bonus, element_skill_forge_bonus, element_skill_enchantment_bonus, element_skill_trading_bonus, element_skill_thief_bonus, element_oppose_strong, element_oppose_strong_dmg, element_oppose_same_dmg, element_oppose_weak, element_oppose_weak_dmg) VALUES (4, 'Adr_element_fire', 'Adr_element_fire_desc', 0, 'Fire.gif', 15, 15, 40, 10, 10, 10, 1, 100, 100, 1, 100);
INSERT INTO phpbb_adr_elements (element_id, element_name, element_desc, element_level, element_img, element_skill_mining_bonus, element_skill_stone_bonus, element_skill_forge_bonus, element_skill_enchantment_bonus, element_skill_trading_bonus, element_skill_thief_bonus, element_oppose_strong, element_oppose_strong_dmg, element_oppose_same_dmg, element_oppose_weak, element_oppose_weak_dmg) VALUES (6, 'Air', 'Element Air', 0, 'Wind.gif', 10, 10, 10, 40, 15, 15, 2, 100, 100, 2, 100);
INSERT INTO phpbb_adr_elements (element_id, element_name, element_desc, element_level, element_img, element_skill_mining_bonus, element_skill_stone_bonus, element_skill_forge_bonus, element_skill_enchantment_bonus, element_skill_trading_bonus, element_skill_thief_bonus, element_oppose_strong, element_oppose_strong_dmg, element_oppose_same_dmg, element_oppose_weak, element_oppose_weak_dmg) VALUES (5, 'Unholy', 'Element Unholy', 1, 'Unholy.gif', 30, 30, 30, 30, 30, 30, 3, 100, 100, 3, 100);

# Config
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('max_characteristic', 20);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('min_characteristic', 6);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('allow_reroll', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('allow_character_delete', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('allow_shop_steal', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('new_shop_price', 500);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('item_modifier_power', 150);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('skill_trading_power', 2);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('skill_thief_failure_damage', 2000);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('skill_thief_failure_punishment', 2);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('skill_thief_failure_type', 2);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('skill_thief_failure_time', 6);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('vault_loan_enable', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('interests_rate', 4);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('interests_time', 432000);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('loan_interests', 8);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('loan_interests_time', 432000);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('loan_max_sum', 5000);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('loan_requirements', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('stock_max_change', 15);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('stock_min_change', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('vault_enable', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_enable', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_monster_stats_modifier', 120);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_base_exp_min', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_base_exp_max', 200);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_base_exp_modifier', 100);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_base_reward_min', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_base_reward_max', 200);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_base_reward_modifier', 100);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('temple_heal_cost', 5);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('temple_resurrect_cost', 25);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('cell_allow_user_caution', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('cell_allow_user_judge', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('cell_allow_user_blank', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('cell_amount_user_blank', 10000);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('cell_user_judge_voters', 10);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('cell_user_judge_posts', 2);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('item_power_level', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('training_skill_cost', 5);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('training_charac_cost', 10);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('training_upgrade_cost', 10000);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('training_allow_change', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('training_change_cost', 100);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('next_level_penalty', 10);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_pvp_enable', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_pvp_defies_max', 5);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('pvp_base_exp_min', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('pvp_base_exp_max', 500);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('pvp_base_exp_modifier', 150);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('pvp_base_reward_min', 50);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('pvp_base_reward_max', 100);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('pvp_base_reward_modifier', 150);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_disable_rpg', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_limit_regen_duration', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_character_battle_limit', 30);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_character_skill_limit', 20);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_character_trading_limit', 100);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_character_thief_limit', 5);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('weight_enable', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_base_sp_modifier', 120);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('posts_min', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_character_limit_enable', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('posts_enable', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_calc_type', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('job_salary_enable', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('job_salary_cron_time', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('job_salary_cron_last_time', 1104681333);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_allow_retire_character', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_minimum_retire_level', 8);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_retire_points_award', 5000);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_retire_points_award_level', 1000);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('event_hi', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_event_limit_enable', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_character_event_limit', 40);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('temple_min_donation', 5);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('temple_win_chance', 90);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('temple_chance_increase', 500);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('temple_super_rare_amount', 10000);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('temple_total_donations', 387896);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('beggar_min_donation', 5);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('beggar_win_chance', 90);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('beggar_chance_increase', 100);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('beggar_super_rare_amount', 5000);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('beggar_total_donations', 64793);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('lake_min_donation', 5);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('lake_win_chance', 90);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('lake_chance_increase', 500);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('lake_super_rare_amount', 5000);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('lake_total_donations', 2181);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_karma_enable', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_karma_min', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_karma_trading_bonus', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_karma_shop_owner_bonus', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_karma_give_bonus', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('last_character_replen', 0);

# Jobs
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (1, 'Town Cryer', 'Notify the town of latest events', 0, 0, 0, 1, 0, 'town_cryer.gif', 500, 300, 717, 3, 5, 7, 75, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (2, 'Priest', 'Spread the word of God throughout your town', 0, 0, 0, 2, 0, 'priest.gif', 600, 400, 735, 3, 3, 7, 100, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (3, 'Miners Guide', 'Guide people thrugh the mines', 0, 7, 0, 1, 0, 'Dwarf.gif', 600, 400, 0, 1, 1, 7, 75, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (4, 'Prison Guard', 'Guard the prison', 0, 3, 0, 5, 0, 'Half-orc.gif', 1000, 700, 712, 2, 2, 7, 100, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (5, 'Bank Guard', 'Guard the Bank', 0, 0, 0, 6, 0, 'Super Guard.gif', 1100, 800, 36, 2, 2, 7, 100, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (6, 'Town Harlet', 'Your the town harlet', 9, 0, 0, 1, 0, 'servant.gif', 500, 300, 0, 1, 1, 7, 75, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (7, 'King', 'You rule the Kingdom', 0, 0, 0, 12, 0, 'King.gif', 2500, 1500, 309, 1, 1, 7, 175, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (8, 'Town Guard', 'Walk the town guarding people', 0, 0, 0, 3, 0, 'Super Guard.gif', 700, 450, 659, 5, 5, 7, 100, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (9, 'Town Freak', 'Your the town freak!!', 0, 0, 0, 1, 0, 'sea creater.gif', 520, 320, 42, 0, 1, 7, 75, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (10, 'Assasin', 'Work for the Thieves guild', 0, 0, 0, 7, 0, 'assassin.gif', 1300, 900, 717, 2, 2, 7, 100, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (11, 'Court Jester', 'Court Jester', 0, 0, 0, 3, 0, 'jester.gif', 700, 450, 42, 1, 1, 7, 100, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (12, 'Town Bully', 'Kick everyone ass', 0, 0, 0, 7, 0, 'bully.gif', 1250, 850, 152, 1, 1, 7, 100, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (13, 'Temple Priestess', 'You work in the temple', 20, 0, 0, 1, 0, 'raceimage1.gif', 600, 400, 0, 1, 1, 7, 100, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (14, 'Temple Priest', 'You work in the temple', 8, 0, 0, 1, 0, 'highpriest.gif', 600, 400, 0, 1, 1, 7, 100, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (15, 'Body Guard', 'Rich Merchant looking for a body guard', 0, 0, 0, 2, 0, 'guard1.gif', 600, 420, 73, 1, 2, 7, 95, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (16, 'Town Duke', 'A Town Noble', 0, 0, 0, 8, 0, 'male elf.gif', 1400, 990, 0, 1, 2, 7, 100, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (17, 'Servant', 'You serve a town Noble', 0, 0, 0, 1, 0, 'peasent.gif', 500, 300, 735, 4, 5, 7, 75, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (18, 'Soul Catcher', 'Vampire needed for soul catching', 0, 9, 0, 1, 0, 'vampire.gif', 750, 550, 719, 1, 1, 7, 100, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (19, 'Treasure Hunting', 'Hunt for the Undead Gauntlets', 0, 0, 0, 1, 0, 'terra-seed_0.gif', 500, 500, 3214, 1, 1, 30, 100, 1);
INSERT INTO phpbb_adr_jobs (job_id, job_name, job_desc, job_class_id, job_race_id, job_alignment_id, job_level, job_auth_level, job_img, job_salary, job_exp, job_item_reward_id, job_slots_available, job_slots_max, job_duration, job_sp_reward, job_payment_intervals) VALUES (20, 'Town Banker', 'You work at the bank', 0, 0, 0, 3, 0, 'sephiroth_0.gif', 650, 450, 726, 1, 2, 7, 100, 1);

# Lake donations kinds
INSERT INTO phpbb_adr_lake_donations (item_id, item_chance, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_weight, item_max_skill, item_add_power, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_sell_back_percentage) VALUES (1, 0, 1, 6601, 6, 3, 150, 150, 'Sword/Bastard Sword.gif', 'Sword of Wounding', 'A Gift From The Lady Of The Lake', 6, 50, 6, 3, 3, 1, 200, 50, 100, 10);
INSERT INTO phpbb_adr_lake_donations (item_id, item_chance, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_weight, item_max_skill, item_add_power, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_sell_back_percentage) VALUES (2, 1, 1, 9900, 6, 5, 200, 200, 'Sword/Holy Sword.gif', 'Sword of Holy Might', 'A Gift From The Lady Of The Lake', 6, 50, 10, 5, 3, 3, 200, 50, 100, 10);
INSERT INTO phpbb_adr_lake_donations (item_id, item_chance, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_weight, item_max_skill, item_add_power, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_sell_back_percentage) VALUES (3, 2, 1, 14851, 6, 8, 200, 200, 'Sword/Fire Sword.gif', 'Sword of Hellfire', 'A Gift From The Lady Of The Lake', 6, 50, 16, 8, 3, 4, 200, 50, 100, 10);
INSERT INTO phpbb_adr_lake_donations (item_id, item_chance, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_weight, item_max_skill, item_add_power, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_sell_back_percentage) VALUES (4, 3, 1, 19800, 6, 11, 325, 325, 'Sword/Long Sword.gif', 'Sword of Crushing', 'A Gift From The Lady Of The Lake', 6, 50, 22, 11, 3, 2, 200, 50, 100, 10);
INSERT INTO phpbb_adr_lake_donations (item_id, item_chance, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_weight, item_max_skill, item_add_power, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_sell_back_percentage) VALUES (5, 4, 1, 26401, 6, 15, 425, 425, 'Sword/Dragon Sword.gif', 'Sword of Destruction', 'A Gift From The Lady Of The Lake', 6, 50, 30, 15, 3, 5, 200, 50, 100, 10);

# Races
INSERT INTO phpbb_adr_races (race_id, race_name, race_desc, race_level, race_img, race_might_bonus, race_dexterity_bonus, race_constitution_bonus, race_intelligence_bonus, race_wisdom_bonus, race_charisma_bonus, race_skill_mining_bonus, race_skill_stone_bonus, race_skill_forge_bonus, race_skill_enchantment_bonus, race_skill_trading_bonus, race_skill_thief_bonus, race_might_malus, race_dexterity_malus, race_constitution_malus, race_intelligence_malus, race_wisdom_malus, race_charisma_malus, race_magic_attack_bonus, race_magic_resistance_bonus, race_magic_attack_malus, race_magic_resistance_malus, race_weight, race_weight_per_level, race_zone_begin, race_zone_name) VALUES (1, 'Adr_race_human', 'Adr_race_human_desc', 0, 'Human.gif', 0, 0, 0, 0, 0, 0, 5, 5, 5, 5, 5, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1000, 5, 2, 'Suzail');
INSERT INTO phpbb_adr_races (race_id, race_name, race_desc, race_level, race_img, race_might_bonus, race_dexterity_bonus, race_constitution_bonus, race_intelligence_bonus, race_wisdom_bonus, race_charisma_bonus, race_skill_mining_bonus, race_skill_stone_bonus, race_skill_forge_bonus, race_skill_enchantment_bonus, race_skill_trading_bonus, race_skill_thief_bonus, race_might_malus, race_dexterity_malus, race_constitution_malus, race_intelligence_malus, race_wisdom_malus, race_charisma_malus, race_magic_attack_bonus, race_magic_resistance_bonus, race_magic_attack_malus, race_magic_resistance_malus, race_weight, race_weight_per_level, race_zone_begin, race_zone_name) VALUES (2, 'Adr_race_half-elf', 'Adr_race_half-elf_desc', 0, 'Half-elf.gif', 0, 1, 0, 0, 0, 1, 0, 5, 0, 10, 5, 10, 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 900, 5, 2, 'Suzail');
INSERT INTO phpbb_adr_races (race_id, race_name, race_desc, race_level, race_img, race_might_bonus, race_dexterity_bonus, race_constitution_bonus, race_intelligence_bonus, race_wisdom_bonus, race_charisma_bonus, race_skill_mining_bonus, race_skill_stone_bonus, race_skill_forge_bonus, race_skill_enchantment_bonus, race_skill_trading_bonus, race_skill_thief_bonus, race_might_malus, race_dexterity_malus, race_constitution_malus, race_intelligence_malus, race_wisdom_malus, race_charisma_malus, race_magic_attack_bonus, race_magic_resistance_bonus, race_magic_attack_malus, race_magic_resistance_malus, race_weight, race_weight_per_level, race_zone_begin, race_zone_name) VALUES (3, 'Orc', 'Race Orc', 0, 'Half-orc.gif', 2, 0, 2, 0, 0, 0, 15, 0, 0, 0, 0, 15, 0, 0, 0, 2, 0, 2, 0, 2, 0, 0, 1500, 5, 2, 'Suzail');
INSERT INTO phpbb_adr_races (race_id, race_name, race_desc, race_level, race_img, race_might_bonus, race_dexterity_bonus, race_constitution_bonus, race_intelligence_bonus, race_wisdom_bonus, race_charisma_bonus, race_skill_mining_bonus, race_skill_stone_bonus, race_skill_forge_bonus, race_skill_enchantment_bonus, race_skill_trading_bonus, race_skill_thief_bonus, race_might_malus, race_dexterity_malus, race_constitution_malus, race_intelligence_malus, race_wisdom_malus, race_charisma_malus, race_magic_attack_bonus, race_magic_resistance_bonus, race_magic_attack_malus, race_magic_resistance_malus, race_weight, race_weight_per_level, race_zone_begin, race_zone_name) VALUES (4, 'Adr_race_elf', 'Adr_race_elf_desc', 0, 'Elf.gif', 0, 2, 0, 2, 0, 0, 0, 0, 5, 15, 10, 0, 2, 0, 2, 0, 0, 0, 2, 0, 0, 0, 800, 5, 2, 'Suzail');

# Shops
INSERT INTO phpbb_adr_shops (shop_id, shop_owner_id, shop_name, shop_desc, shop_logo) VALUES (1, 1, 'Adr_shop_forums', 'Adr_shop_forums_desc', '');
INSERT INTO phpbb_adr_shops (shop_id, shop_owner_id, shop_name, shop_desc, shop_logo) VALUES (4, 445, 'Enchanter''s Tower:  Requests accepted by PM', 'Selling a few weakly (+3-9) enchanted items.  PM me with requests for more powerful items.  Prices will go down if stuff sells!', '');
INSERT INTO phpbb_adr_shops (shop_id, shop_owner_id, shop_name, shop_desc, shop_logo) VALUES (8, 478, 'Agouti''s Emporium', 'various curios are sold here(swords, armor, and other interesting artifacts)', '');

# Shop Items
INSERT INTO phpbb_adr_shops_items (item_id, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_in_shop, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_store_id, item_weight, item_auth, item_max_skill, item_add_power, item_monster_thief, item_in_warehouse, item_sell_back_percentage, item_thief_karma, item_thief_karma_fail, item_zone, item_zone_name) VALUES (513, 1, 56, 3, 1, 1, 1, 'Fire Magic.gif', 'Fire Ball', 'Fire Ball', 11, 0, 1, 4, 200, 50, 100, 8, 1, 0, 0, 0, 0, 0, 10, 0, 0, 0, '0');
INSERT INTO phpbb_adr_shops_items (item_id, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_in_shop, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_store_id, item_weight, item_auth, item_max_skill, item_add_power, item_monster_thief, item_in_warehouse, item_sell_back_percentage, item_thief_karma, item_thief_karma_fail, item_zone, item_zone_name) VALUES (14, 1, 660, 5, 2, 75, 75, 'armor/shadow_cloak.gif', 'Shadow Cloak', 'Shadow Cloak', 7, 0, 0, 0, 100, 100, 100, 9, 10, 0, 4, 0, 0, 0, 10, 0, 0, 0, '0');
INSERT INTO phpbb_adr_shops_items (item_id, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_in_shop, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_store_id, item_weight, item_auth, item_max_skill, item_add_power, item_monster_thief, item_in_warehouse, item_sell_back_percentage, item_thief_karma, item_thief_karma_fail, item_zone, item_zone_name) VALUES (15, 1, 154, 1, 6, 175, 175, 'armor/quarter_platemail.gif', 'Quarter Platemail', 'Quarter Platemail', 7, 0, 0, 0, 100, 100, 100, 3, 250, 0, 12, 0, 0, 0, 10, 0, 0, 0, '0');
INSERT INTO phpbb_adr_shops_items (item_id, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_in_shop, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_store_id, item_weight, item_auth, item_max_skill, item_add_power, item_monster_thief, item_in_warehouse, item_sell_back_percentage, item_thief_karma, item_thief_karma_fail, item_zone, item_zone_name) VALUES (16, 1, 386, 2, 6, 175, 175, 'armor/half_platemail.gif', 'Half Platemail', 'Half Platemail', 7, 0, 0, 0, 100, 100, 100, 3, 300, 0, 12, 0, 0, 0, 10, 0, 0, 0, '0');
INSERT INTO phpbb_adr_shops_items (item_id, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_in_shop, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_store_id, item_weight, item_auth, item_max_skill, item_add_power, item_monster_thief, item_in_warehouse, item_sell_back_percentage, item_thief_karma, item_thief_karma_fail, item_zone, item_zone_name) VALUES (17, 1, 771, 3, 6, 175, 175, 'armor/threequarter_platemail.gif', 'Three Quarter Platemail', 'Three Quarter Platemail', 7, 0, 0, 0, 100, 100, 100, 3, 350, 0, 12, 0, 0, 0, 10, 0, 0, 0, '0');
INSERT INTO phpbb_adr_shops_items (item_id, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_in_shop, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_store_id, item_weight, item_auth, item_max_skill, item_add_power, item_monster_thief, item_in_warehouse, item_sell_back_percentage, item_thief_karma, item_thief_karma_fail, item_zone, item_zone_name) VALUES (20, 1, 1761, 5, 7, 200, 200, 'armor/silver_full_plate.gif', 'Silver Full Plate', 'Silver Full Plate', 7, 0, 0, 0, 100, 100, 100, 3, 400, 0, 14, 0, 0, 0, 10, 0, 0, 0, '0');
INSERT INTO phpbb_adr_shops_items (item_id, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_in_shop, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_store_id, item_weight, item_auth, item_max_skill, item_add_power, item_monster_thief, item_in_warehouse, item_sell_back_percentage, item_thief_karma, item_thief_karma_fail, item_zone, item_zone_name) VALUES (21, 1, 1232, 4, 7, 200, 200, 'armor/shadow_full_plate.gif', 'Shadow Full Plate', 'Shadow Full Plate', 7, 0, 0, 0, 100, 100, 100, 3, 400, 0, 14, 0, 0, 0, 10, 0, 0, 0, '0');
INSERT INTO phpbb_adr_shops_items (item_id, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_in_shop, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_store_id, item_weight, item_auth, item_max_skill, item_add_power, item_monster_thief, item_in_warehouse, item_sell_back_percentage, item_thief_karma, item_thief_karma_fail, item_zone, item_zone_name) VALUES (22, 1, 441, 2, 7, 200, 200, 'armor/ruby_full_plate.gif', 'Ruby Full Plate', 'Ruby Full Plate', 7, 0, 0, 0, 100, 100, 100, 3, 400, 0, 14, 0, 0, 0, 10, 0, 0, 0, '0');
INSERT INTO phpbb_adr_shops_items (item_id, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_in_shop, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_store_id, item_weight, item_auth, item_max_skill, item_add_power, item_monster_thief, item_in_warehouse, item_sell_back_percentage, item_thief_karma, item_thief_karma_fail, item_zone, item_zone_name) VALUES (23, 1, 2310, 6, 6, 175, 175, 'armor/saphire_full_plate.gif', 'Saphire Full Plate', 'Saphire Full Plate', 7, 0, 0, 0, 100, 100, 100, 3, 400, 0, 12, 0, 0, 0, 10, 0, 0, 0, '0');
INSERT INTO phpbb_adr_shops_items (item_id, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_in_shop, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_store_id, item_weight, item_auth, item_max_skill, item_add_power, item_monster_thief, item_in_warehouse, item_sell_back_percentage, item_thief_karma, item_thief_karma_fail, item_zone, item_zone_name) VALUES (24, 1, 2310, 6, 6, 175, 175, 'armor/emerald_full_plate.gif', 'Emerald Full Plate', 'Emerald Full Plate', 7, 0, 0, 0, 100, 100, 100, 3, 400, 0, 12, 0, 0, 0, 10, 0, 0, 0, '0');
INSERT INTO phpbb_adr_shops_items (item_id, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_in_shop, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_store_id, item_weight, item_auth, item_max_skill, item_add_power, item_monster_thief, item_in_warehouse, item_sell_back_percentage, item_thief_karma, item_thief_karma_fail, item_zone, item_zone_name) VALUES (26, 1, 1981, 6, 5, 150, 150, 'armor/gold_chest_plate.gif', 'Gold Chest Plate', 'Gold Chest Plate', 7, 0, 0, 0, 100, 100, 100, 3, 300, 0, 10, 0, 0, 0, 10, 0, 0, 0, '0');

# Item Qualities
INSERT INTO phpbb_adr_shops_items_quality (item_quality_id, item_quality_modifier_price, item_quality_lang) VALUES (0, 0, 'Adr_dont_care');
INSERT INTO phpbb_adr_shops_items_quality (item_quality_id, item_quality_modifier_price, item_quality_lang) VALUES (1, 20, 'Adr_items_quality_very_poor');
INSERT INTO phpbb_adr_shops_items_quality (item_quality_id, item_quality_modifier_price, item_quality_lang) VALUES (2, 50, 'Adr_items_quality_poor');
INSERT INTO phpbb_adr_shops_items_quality (item_quality_id, item_quality_modifier_price, item_quality_lang) VALUES (3, 100, 'Adr_items_quality_medium');
INSERT INTO phpbb_adr_shops_items_quality (item_quality_id, item_quality_modifier_price, item_quality_lang) VALUES (4, 140, 'Adr_items_quality_good');
INSERT INTO phpbb_adr_shops_items_quality (item_quality_id, item_quality_modifier_price, item_quality_lang) VALUES (5, 200, 'Adr_items_quality_very_good');
INSERT INTO phpbb_adr_shops_items_quality (item_quality_id, item_quality_modifier_price, item_quality_lang) VALUES (6, 300, 'Adr_items_quality_excellent');

# Item Types
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (0, 0, 'Adr_dont_care');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (1, 3, 'Adr_items_type_raw_materials');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (2, 5, 'Adr_items_type_rare_raw_materials');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (3, 100, 'Adr_items_type_tools_pickaxe');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (4, 100, 'Adr_items_type_tools_magictome');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (5, 100, 'Adr_items_type_weapon');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (6, 1000, 'Adr_items_type_enchanted_weapon');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (7, 200, 'Adr_items_type_armor');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (8, 100, 'Adr_items_type_buckler');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (9, 75, 'Adr_items_type_helm');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (29, 150, 'Adr_items_type_greave');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (30, 50, 'Adr_items_type_boot');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (10, 50, 'Adr_items_type_gloves');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (11, 50, 'Adr_items_type_magic_attack');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (12, 50, 'Adr_items_type_magic_defend');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (13, 7000, 'Adr_items_type_amulet');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (14, 6000, 'Adr_items_type_ring');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (15, 20, 'Adr_items_type_health_potion');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (16, 20, 'Adr_items_type_mana_potion');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (17, 1, 'Adr_items_type_misc');

# Skills
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (1, 'Adr_mining', 'Adr_skill_mining_desc', 'skill_mining.gif', 80, 1);
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (2, 'Adr_stone', 'Adr_skill_stone_desc', 'skill_stone.gif', 90, 1);
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (3, 'Adr_forge', 'Adr_skill_forge_desc', 'skill_forge.gif', 35, 1);
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (4, 'Adr_enchantment', 'Adr_skill_enchantment_desc', 'skill_enchantment.gif', 40, 1);
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (5, 'Adr_trading', 'Adr_skill_trading_desc', 'skill_trading.gif', 125, 1);
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (6, 'Adr_thief', 'Adr_skill_thief_desc', 'skill_thief.gif', 25, 1);

# Stores
INSERT INTO phpbb_adr_stores (store_id, store_name, store_desc, store_img, store_status, store_sales_status, store_admin, store_owner_id, store_owner_img, store_owner_speech) VALUES (1, 'The Bards Shop', 'For all your Bards needs', 'Forum.gif', 1, 0, 0, 1, 'Forum.gif', 'Is there a particular instrument you prefer?');
INSERT INTO phpbb_adr_stores (store_id, store_name, store_desc, store_img, store_status, store_sales_status, store_admin, store_owner_id, store_owner_img, store_owner_speech) VALUES (2, 'Admin Only Store', 'Viewable only by the board admin', '', 1, 0, 1, 1, '', '');
INSERT INTO phpbb_adr_stores (store_id, store_name, store_desc, store_img, store_status, store_sales_status, store_admin, store_owner_id, store_owner_img, store_owner_speech) VALUES (3, 'The Grey Dwarf''s Armory', 'Get your quality armor here.', 'minning.gif', 1, 0, 0, 1, 'minning.gif', 'Armor made in the best Dwarven Forges around.');

# Zones
INSERT INTO `phpbb_adr_zones` (`zone_id`, `zone_name`, `zone_desc`, `zone_img`, `zone_element`, `zone_item`, `cost_goto1`, `cost_goto2`, `cost_goto3`, `cost_goto4`, `cost_return`, `goto1_id`, `goto2_id`, `goto3_id`, `goto4_id`, `return_id`, `zone_shops`, `zone_forge`, `zone_prison`, `zone_temple`, `zone_bank`, `zone_event1`, `zone_event2`, `zone_event3`, `zone_event4`, `zone_event5`, `zone_event6`, `zone_event7`, `zone_event8`, `zone_pointwin1`, `zone_pointwin2`, `zone_pointloss1`, `zone_pointloss2`, `zone_chance`, `zone_mine`, `zone_enchant`, `zone_monsters_list`, `zone_level`) VALUES
(1, 'World Map', 'Map of the World', 'World.gif', 'Earth', '0', 0, 0, 0, 0, 0, '', '', '', '', 'World Map', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
(2, 'Suzail', 'Suzail is the royal capital and richest city of the kingdom of Cormyr', 'cormyr', 'Feu', '0', 0, 0, 0, 0, 0, 0, 3, 5, 0, 'Kings Forest', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 10, 20, 10, 20, 20, 1, 1, '1338', 0),
(3, 'Marsember', 'Marsember is the second largest city in the kingdom of Cormyr', 'Marsember', 'Fire', '0', 10, 10, 10, 10, 10, 0, 0, 0, '', 2, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 5, 100, 2, 100, 500, 0, 0, '', 5),
(4, 'Kings Forest', 'This forest is owned by the crown and is rich in game and wildlife', 'Kings_Forest', 'Earth', '0', 0, 0, 0, 0, 0, 5, 2, '', 8, '', 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 5, 50, 5, 50, 80, 0, 0, '', 0),
(5, 'Eastern Cormyr Crossroads', 'Eastern Cormyr crossroads', 'Cormyr_Crossroads', 'Earth', '0', 0, 0, 50, 0, 0, 4, '', 8, 3, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 5, 100, 5, 100, 80, 0, 0, '', 0),
(6, 'Arabel', 'Arabel is a fortified city with though it has mant posts for tradeing', 'Arabel', 'Holy', '0', 0, 0, 0, 0, 0, 2, 1, '', 3, 7, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 5, 100, 5, 100, 80, 0, 0, '', 0),
(7, 'Tilverton', 'Tilverton is a small city and is in a strategic location for the kingdom of Cormyr', 'Tilverton', 'Unholy', '0', 0, 0, 0, 0, 0, 1, 2, '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 100, 5, 100, 50, 0, 0, '', 0),
(8, 'Hullack Forest', 'One of the large remaining shards of the great woods that was Cormanthor.', 'Hullack_Forest', 'Air', '0', 0, 0, 0, 0, 0, 1, '', '', 3, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 5, 50, 5, 50, 10, 0, 0, '', 0);

# Rabbitoshi pets
INSERT INTO phpbb_rabbitoshi_config (creature_id, creature_name, creature_prize, creature_power, creature_magicpower, creature_armor, creature_max_hunger, creature_max_thirst, creature_max_health, creature_mp_max, creature_max_hygiene, creature_food_id, creature_buyable, creature_evolution_of, creature_img, creature_experience_max, creature_max_attack, creature_max_magicattack) VALUES (3, 'Wolf', 500, 0, 0, 0, 15, 15, 15, 6, 15, 3, 1, 0, 'wolfpup.gif', 250, 2, 0);
INSERT INTO phpbb_rabbitoshi_config (creature_id, creature_name, creature_prize, creature_power, creature_magicpower, creature_armor, creature_max_hunger, creature_max_thirst, creature_max_health, creature_mp_max, creature_max_hygiene, creature_food_id, creature_buyable, creature_evolution_of, creature_img, creature_experience_max, creature_max_attack, creature_max_magicattack) VALUES (4, 'Rabbit', 100, 0, 0, 0, 15, 15, 15, 6, 15, 2, 1, 0, 'Rabbit.gif', 250, 2, 0);
INSERT INTO phpbb_rabbitoshi_config (creature_id, creature_name, creature_prize, creature_power, creature_magicpower, creature_armor, creature_max_hunger, creature_max_thirst, creature_max_health, creature_mp_max, creature_max_hygiene, creature_food_id, creature_buyable, creature_evolution_of, creature_img, creature_experience_max, creature_max_attack, creature_max_magicattack) VALUES (5, 'Fairy', 5000, 0, 1, 0, 20, 20, 20, 15, 25, 1, 1, 0, 'fairy38.gif', 250, 0, 2);
INSERT INTO phpbb_rabbitoshi_config (creature_id, creature_name, creature_prize, creature_power, creature_magicpower, creature_armor, creature_max_hunger, creature_max_thirst, creature_max_health, creature_mp_max, creature_max_hygiene, creature_food_id, creature_buyable, creature_evolution_of, creature_img, creature_experience_max, creature_max_attack, creature_max_magicattack) VALUES (6, 'Phoenix', 1000, 0, 0, 1, 20, 20, 20, 10, 20, 4, 1, 0, 'ph2.gif', 250, 1, 1);

# Rabbitoshi config
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('thirst_time', 43200);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('thirst_value', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('hunger_time', 43200);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('hunger_value', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('hygiene_time', 43200);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('hygiene_value', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('health_time', 43200);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('health_value', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('rebirth_enable', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('rebirth_price', 0);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('vet_enable', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('vet_price', 100);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('hotel_enable', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('hotel_cost', 10);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('evolution_enable', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('evolution_cost', 200);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('evolution_time', 25);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('exp_lose', 5);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('health_price', 75);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('hunger_price', 20);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('thirst_price', 20);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('hygiene_price', 20);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('level_price', 1500);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('power_price', 330);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('magicpower_price', 280);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('armor_price', 750);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('attack_price', 225);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('magicattack_price', 200);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('mp_price', 30);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('health_raise', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('hunger_raise', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('thirst_raise', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('hygiene_raise', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('power_raise', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('magicpower_raise', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('armor_raise', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('attack_raise', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('magicattack_raise', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('mp_raise', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('level_raise', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('experience_min', 5);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('experience_max', 20);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('mp_min', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('mp_max', 5);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('attack_reload', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('magic_reload', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('regeneration_level', 12);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('regeneration_magicpower', 25);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('regeneration_mp', 50);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('regeneration_mp_need', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('regeneration_hp_give', 3);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('regeneration_price', 1500);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('health_transfert_level', 24);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('health_transfert_magicpower', 50);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('health_transfert_health', 200);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('health_transfert_percent', 50);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('health_transfert_price', 2500);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('mana_transfert_level', 24);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('mana_transfert_magicpower', 50);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('mana_transfert_mp', 100);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('mana_transfert_percent', 50);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('mana_transfert_price', 2500);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('sacrifice_level', 48);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('sacrifice_power', 100);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('sacrifice_armor', 50);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('sacrifice_mp', 100);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('sacrifice_price', 5000);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('health_levelup', 5);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('hunger_levelup', 2);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('thirst_levelup', 2);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('hygiene_levelup', 2);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('power_levelup', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('magicpower_levelup', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('armor_levelup', 0);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('mp_levelup', 3);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('attack_levelup', 1);
INSERT INTO phpbb_rabbitoshi_general (config_name, config_value) VALUES ('magicattack_levelup', 1);

# Adr general config
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_version', '0.4.5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('adr_seasons', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('adr_seasons_time', '86400');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('adr_seasons_last_time', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('zone_bonus_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('zone_bonus_att', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('zone_bonus_def', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('zone_dead_travel', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('stock_use', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('stock_time', '86400');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('stock_last_change', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_experience_for_new', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_experience_for_reply', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_experience_for_edit', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_topics_display', '1-1-0-0-0-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_profile_display', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_time_start', 'time()');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_character_age', '16');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_skill_sp_enable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_character_sp_enable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_thief_enable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_thief_points', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_warehouse_duration', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_shop_duration', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_warehouse_tax', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_shop_tax', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rabbitoshi_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rabbitoshi_name', 'Rabbistoshi');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rabbitoshi_enable_cron', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rabbitoshi_cron_time', '86400');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rabbitoshi_cron_last_time', '0');

# ADR 0.4
UPDATE phpbb_adr_characters SET character_limit_update = 0; 

# ADR 0.4.1
UPDATE phpbb_adr_general SET `config_value` = '0' WHERE `config_name` = 'Adr_disable_rpg';
UPDATE phpbb_adr_stores SET store_status = 1;
UPDATE phpbb_adr_stores SET store_sales_status = 0;

# ADR 0.4.2
UPDATE phpbb_adr_general SET `config_value` = '0' WHERE `config_name` = 'Adr_disable_rpg';

UPDATE phpbb_adr_battle_list SET battle_text = '' WHERE battle_result != 0;
UPDATE phpbb_adr_battle_pvp SET battle_text = '' WHERE battle_result != 3;

# ADR 0.4.4
UPDATE phpbb_adr_shops_items SET item_element_str_dmg = 100, item_element_same_dmg = 100, item_element_weak_dmg = 100 WHERE item_element = 0; 

INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_shop_steal_sell', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_shop_steal_min_lvl', 5);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_shop_steal_show', 0);

# ADR - Advanced NPC System Expansion
UPDATE `phpbb_adr_npc` SET `npc_class` = '0';
UPDATE `phpbb_adr_npc` SET `npc_race` = '0';
UPDATE `phpbb_adr_npc` SET `npc_character_level` = '0';
UPDATE `phpbb_adr_npc` SET `npc_element` = '0';
UPDATE `phpbb_adr_npc` SET `npc_alignment` = '0';
UPDATE `phpbb_adr_npc` SET `npc_visit_prerequisite` = '0';
UPDATE `phpbb_adr_npc` SET `npc_quest_prerequisite` = '0';
UPDATE `phpbb_adr_npc` SET `npc_view` = '0';
INSERT INTO `phpbb_adr_general` VALUES ('npc_image_size', 75);
INSERT INTO `phpbb_adr_general` VALUES ('npc_image_count', 10);
INSERT INTO `phpbb_adr_general` VALUES ('npc_display_enable', 1);
INSERT INTO `phpbb_config` VALUES ('zone_adr_moderators', '');
INSERT INTO `phpbb_config` VALUES ('zone_cheat_member_pm', '2');
INSERT INTO `phpbb_config` VALUES ('zone_cheat_auto_ban_adr', '0');
INSERT INTO `phpbb_config` VALUES ('zone_cheat_auto_ban_board', '0');
INSERT INTO `phpbb_config` VALUES ('zone_cheat_auto_jail', '0');
INSERT INTO `phpbb_config` VALUES ('zone_cheat_auto_time_day', '1');
INSERT INTO `phpbb_config` VALUES ('zone_cheat_auto_time_hour', '0');
INSERT INTO `phpbb_config` VALUES ('zone_cheat_auto_time_minute', '0');
INSERT INTO `phpbb_config` VALUES ('zone_cheat_auto_caution', '0');
INSERT INTO `phpbb_config` VALUES ('zone_cheat_auto_freeable', '0');
INSERT INTO `phpbb_config` VALUES ('zone_cheat_auto_cautionable', '0');
INSERT INTO `phpbb_config` VALUES ('zone_cheat_auto_punishment', '1');
INSERT INTO `phpbb_config` VALUES ('zone_cheat_auto_public', '0');
INSERT INTO `phpbb_adr_general` VALUES ('npc_display_text', 1);
INSERT INTO `phpbb_adr_general` VALUES ('npc_image_link', 1);
INSERT INTO `phpbb_adr_general` VALUES ('npc_button_link', 1);

# ADR - Brewing
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (7, 'Adr_brewing', 'Adr_skill_brewing_desc', 'skill_brewing.gif', 50, 5);

INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (18, 50, 'Adr_items_type_tools_brewing');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (19, 50, 'Adr_items_type_potion');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (20, 50, 'Adr_items_type_recipe');

# ADR - Cooking
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (55, 50, 'Adr_items_type_tools_cooking');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (94, 50, 'Adr_items_type_food');
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (12, 'Adr_cooking', 'Adr_skill_cooking_desc', 'skill_cooking.gif', 50, 5);

# ADR - Blacksmithing
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (13, 'Adr_blacksmithing', 'Adr_skill_blacksmithing_desc', 'skill_blacksmithing.gif', 50, 5);
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (95, 100, 'Adr_items_type_tools_blacksmithing');

# ADR - Skills
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (8, 'Adr_lumberjack', 'Adr_skill_lumberjack_desc', 'skill_lumberjack.gif', 100, 5);
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (9, 'Adr_tailoring', 'Adr_skill_tailoring_desc', 'skill_tailoring.gif', 100, 5);
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (10, 'Adr_herbalism', 'Adr_skill_herbalism_desc', 'skill_herbalism.gif', 100, 5);
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (11, 'Adr_hunting', 'Adr_skill_hunting_desc', 'skill_hunting.gif', 100, 50);
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (14, 'Adr_alchemy', 'Adr_skill_alchemy_desc', 'skill_alchemy.gif', 100, 5);
INSERT INTO phpbb_adr_skills (skill_id, skill_name, skill_desc, skill_img, skill_req, skill_chance) VALUES (15, 'Adr_fishing', 'Adr_skill_fishing_desc', 'skill_fishing.gif', 100, 5);

INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (22, 50, 'Adr_items_type_tools_needle');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (23, 50, 'Adr_items_type_clothes');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (24, 50, 'Adr_items_type_thread');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (25, 50, 'Adr_items_type_tools_seed');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (26, 50, 'Adr_items_type_plants');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (27, 50, 'Adr_items_type_water');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (28, 50, 'Adr_items_type_tools_hunting');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (31, 50, 'Adr_items_type_wood');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (32, 50, 'Adr_items_type_tools_pole');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (33, 50, 'Adr_items_type_fish');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (34, 17, 'Adr_items_type_tools_alchemy');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (35, 517, 'Adr_items_type_alchemy');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (36, 150, 'Adr_items_type_animals');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (37, 50, 'Adr_items_type_tools_woodworking');

# ADR - Advanced Spells
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (107, 1, 'Adr_items_type_spell_attack');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (108, 1, 'Adr_items_type_magic_heal');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (109, 1, 'Adr_items_type_spell_defend');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (110, 50, 'Adr_items_type_spell_recipe');


# ADR - Dynamic Town Map
#INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (297, 'TowerHill', '', 'zone 1', 0, '', 'zone 1', '', 101, 0);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (298, 'battlearena_1', '', 'Battle Arena', 0, '', 'adr_battle', '', 15, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (300, 'Battle2', '', 'Battle Arena 2', 0, '', 'adr_battle', '', 15, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (301, 'Cauldron', '', 'Magical Cauldron', 0, '', 'adr_cauldron', '', 2, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (302, 'compass', '', 'Compass1', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (303, 'compass2', '', 'Compass2', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (304, 'compass3', '', 'Compass3', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (305, 'dirt1', '', 'Dirt Patch', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (306, 'dragon', '', 'Dragon Image', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (307, 'Exit1', '', 'Exit Tower', 0, '', 'index', '', 25, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (308, 'Forge1', '', 'Forge', 0, '', 'adr_TownMap_forge', '', 20, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (309, 'Forge2', '', 'Forge 2', 0, '', 'adr_TownMap_forge', '', 20, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (310, 'hill1', '', 'Hill', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (313, 'Info1', '', 'Tower of Knowledge', 0, '', 'adr_library', '', 5, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (314, 'inn_1', '', 'Village Inn', 0, '', 'adr_guilds', '', 19, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (315, 'INN2', '', 'Village Inn 2', 0, '', 'adr_guilds', '', 19, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (316, 'jail1', '', 'Prison', 0, '', 'adr_courthouse', '', 14, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (317, 'jail2', '', 'Prison 2', 0, '', 'adr_courthouse', '', 14, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (318, 'magic1', '', 'Tower of Magic', 0, '', '', '', 12, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (319, 'magic2', '', 'Tower of Magic 2', 0, '', '', '', 10, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (320, 'mine1', '', 'Mines', 0, '', 'adr_mine', '', 11, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (321, 'mine2', '', 'Mines 2', 0, '', '', 'adr_mine', 11, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (322, 'mountain1_01', '', 'Mountain-Left Top', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (323, 'mountain1_02', '', 'Mountain-Right Top', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (324, 'mountain1_03', '', 'Mountain-Left Bottom', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (325, 'mountain1_04', '', 'Mountain-Right Bottom', 0, '', '', '', 999, 2);
-- INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (326, 'pond1', '', 'Pond', 0, '', '', '', 999, 2);
-- INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (328, 'SMpond', '', 'Pond', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (329, 'shop1', '', 'Shop', 0, '', 'adr_shops', '', 26, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (330, 'shop2', '', 'Shop 2', 0, '', 'adr_shops', '', 26, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (331, 'shop3', '', 'Shop 3', 0, '', 'adr_shops', '', 26, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (332, 'shrub', '', 'Shrubs', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (333, 'statue', '', 'Statue', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (335, 'Tavern2', '', 'Taverne des guildes #2', 0, '', 'adr_guilds', '', 0, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (336, 'Temple1', '', 'Temple', 0, '', 'adr_temple', '', 27, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (337, 'Temple2', '', 'Temple 2', 0, '', 'adr_temple', '', 27, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (338, 'Tower1', '', 'Tower', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (339, 'castle2', '', 'Castle', 0, '', '', '', 999, 0);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (342, 'Trees1', '', 'Trees 1', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (343, 'Trees2', '', 'Trees 2', 0, '', '', '', 999, 2);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (344, 'trees3', '', 'Trees 3', 0, '', '', '', 999, 2);

# V: let's get TownMap-y :D
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (299, 'bank_1', '', 'Town Bank', 0, '', 'adr_TownMap_Banque', '', 18, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (311, 'Home1', '', 'Character Home', 0, '', 'adr_TownMap_Maison', '', 4, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (312, 'Home2', '', 'Character Home 2', 0, '', 'adr_TownMap_Maison', '', 4, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (327, 'Rune1', '', 'Rune Stone', 0, '', 'adr_TownMap_pierrerunique', '', 12, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (334, 'Tavern1', '', 'Clans', 0, '', 'adr_clans', '', 59, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (340, 'Training1', '', 'Training Grounds', 0, '', 'adr_TownMap_Entrainement', '', 16, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (341, 'Training2', '', 'Training Grounds2', 0, '', 'adr_TownMap_Entrainement', '', 16, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (345, 'warehouse1', '', 'Character Warehouse', 0, '', 'adr_TownMap_Entrepot', '', 42, 1);
# V: and now, let's add other pages ...
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (346, 'alchemy', '', 'Alchemy', 0, '', 'adr_alchemy', '', 28, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (347, 'beggar', '', 'Beggar Donation', 0, '', 'adr_beggar', '', 29, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (348, 'smithy', '', 'Blacksmithing', 0, '', 'adr_blacksmithing', '', 30, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (349, 'brewing', '', 'Brewing', 0, '', 'adr_brewing', '', 31, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (350, 'farmhouse', '', 'Cooking', 0, '', 'adr_cooking', '', 32, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (351, 'enchant', '', 'Enchant', 0, '', 'adr_enchant', '', 33, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (352, 'fish', '', 'Fishing', 0, '', 'adr_fish', '', 34, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (353, 'herbal', '', 'Herbalism', 0, '', 'adr_herbal', '', 35, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (354, 'hunting', '', 'Hunting', 0, '', 'adr_hunting', '', 36, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (355, 'magic_lake', '', 'Magic Lake', 0, '', 'adr_lake', '', 37, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (356, 'jobs', '', 'Jobs', 0, '', 'adr_jobs', '', 38, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (357, 'lumberjack', '', 'Lumberjacking', 0, '', 'adr_lumberjack', '', 39, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (358, 'party', '', 'Party', 0, '', 'adr_party', '', 40, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (359, 'tailor', '', 'Tailoring', 0, '', 'adr_tailor', '', 41, 1);
INSERT INTO phpbb_adr_zone_buildings (id, name, shop, sdesc, record_id, type, zone_link, zone_name_tag, zone_building_tag_no, zone_building_type) VALUES (359, 'Headquarters', '', 'Headquarters', 0, '', 'adr_clans', '', 59, 1);

INSERT INTO phpbb_adr_zone_maps (zone_id, zonemap_type, zone_world, zonemap_buildings) VALUES (1, 1, 1, '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~zone 1~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Castle~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~');
INSERT INTO phpbb_adr_zone_maps (zone_id, zonemap_type, zone_world, zonemap_buildings) VALUES (2, 2, 0, '~~~~~~~~~~~~~~Temple~~~Mines~~~~~Town Bank~~~~~~~~~Trees 3~~~Shop~~Battle Arena 2~~~~~Character Warehouse~Trees 2~~Statue~Taverne~~~~~~~Forge~~~~Character Home~~~~~~~~~Pond~Mountain-Left Top~Mountain-Right Top~~~~Trees 1~Village Inn~~~~Mountain-Left Bottom~Mountain-Right Bottom~Magical Cauldron~~~~~~Exit Tower~~Tower of Knowledge~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~');

INSERT INTO `phpbb_adr_zone_townmaps` (`zonemap_type`, `zonemap_name`, `zonemap_bg`, `zonemap_width`, `zonemap_cellwidth`, `zonemap_cellwidthnumber`, `zonemap_height`, `zonemap_cellheight`, `zonemap_cellheightnumber`, `zonemap_building`) VALUES
(1, 'World Map', 'World.gif', 900, 44, 20, 750, 45, 16, ',22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,242,246,247,248,249,250,251,252,253,254,255,256,257,258,259,262,266,267,268,269,270,271,272,273,274,275,276,283,284,292,293,294,295'),
(2, 'Small Town', 'ZoneMap_1.gif', 484, 48, 10, 470, 47, 10, ',12,13,14,15,16,17,18,22,23,24,25,26,27,28,29,32,33,34,35,36,37,38,39,42,43,44,45,46,47,48,49,52,53,54,55,56,57,58,59,62,63,64,65,66,67,68,69,72,73,74,75,76,77,78,79,85,87,88'),
(3, 'Champs avec pont', 'ZoneMap_2.gif', 484, 48, 10, 470, 47, 10, ',18,19,42,43,52,53,54,58,59,62,63,64,65,66,67,68,69,72,73,74,75,76,77,78,79,82,83,84,85,86,87,88'),
(4, 'Lopin de terre dans un précipice', 'ZoneMap_3.gif', 382, 42, 9, 476, 45, 11, ',11,12,13,14,15,16,17,20,21,22,23,24,25,26,29,30,31,32,33,34,35,38,39,40,41,42,43,44,47,48,49,50,51,52,53,56,57,58,59,60,61,62,65,66,67,68,69,70,71,74,75,76,77,78,79,80'),
(5, 'Forêt dense', 'ZoneMap_4.gif', 484, 48, 10, 470, 47, 10, ',12,13,14,15,16,17,18,19,22,23,24,25,26,27,28,29,32,33,34,35,36,37,38,39,42,43,44,45,46,47,48,49,52,53,54,55,56,57,58,59,62,63,64,65,66,67,68,69,72,73,74,75,76,77,78,79,82,83,84,85,86,87,88,89'),
(6, 'Champs', 'ZoneMap_6.gif', 484, 48, 10, 470, 47, 10, ',12,13,14,15,16,17,18,19,22,23,24,25,26,27,28,29,32,33,34,35,36,37,38,39,42,43,44,45,46,47,48,49,52,53,54,55,56,57,58,59,62,63,64,65,66,67,68,72,73,74,75,76,77,78,79,82,83,84,85,86,87,88'),
(7, 'Vue du dessus avec haut droit/bas gauche gris', 'ZoneMap_6.gif', 484, 48, 10, 470, 47, 10, ',12,13,14,22,23,24,25,32,33,34,35,36,42,43,44,45,46,47,48,49,52,53,54,55,56,57,58,59,62,63,64,65,66,67,68,72,73,74,75,76,77,78,79,85,86,87,88'),
(8, 'Marecages', 'ZoneMap_7.gif', 484, 48, 10, 470, 47, 10, ',11,12,13,14,15,16,17,20,21,22,23,24,25,26,29,30,31,32,33,34,35,38,39,40,41,42,43,44,47,48,49,50,51,52,53,56,57,58,59,60,61,62,65,66,67,68,69,70,71,74,75,76,77,78,79,80'),
(9, 'Herbe avec routes', 'ZoneMap_8.gif', 484, 48, 10, 470, 47, 10, ',11,12,13,14,15,16,17,20,21,22,23,24,25,26,29,30,31,32,33,34,35,38,39,40,41,42,43,44,47,48,49,50,51,52,53,56,57,58,59,60,61,62,65,66,67,68,69,70,71,74,75,76,77,78,79,80'),
(10, 'Herbe avec une route verticale', 'ZoneMap_9.gif', 484, 48, 10, 470, 47, 10, ',11,12,13,14,15,16,17,20,21,22,23,24,25,26,29,30,31,32,33,34,35,38,39,40,41,42,43,44,47,48,49,50,51,52,53,56,57,58,59,60,61,62,65,66,67,68,69,70,71,74,75,76,77,78,79,80'),
(11, 'Herbe avec une route horizontale', 'ZoneMap_10.gif', 484, 48, 10, 470, 47, 10, ',11,12,13,14,15,16,17,20,21,22,23,24,25,26,29,30,31,32,33,34,35,38,39,40,41,42,43,44,47,48,49,50,51,52,53,56,57,58,59,60,61,62,65,66,67,68,69,70,71,74,75,76,77,78,79,80'),
(12, 'Vague', 'ZoneMap_11.gif', 484, 48, 10, 470, 47, 10, ',11,12,13,14,15,16,17,20,21,22,23,24,25,26,29,30,31,32,33,34,35,38,39,40,41,42,43,44,47,48,49,50,51,52,53,56,57,58,59,60,61,62,65,66,67,68,69,70,71,74,75,76,77,78,79,80'),
(13, 'Eau avec geyser', 'ZoneMap_12.gif', 484, 48, 10, 470, 47, 10, ',11,12,13,14,15,16,17,20,21,22,23,24,25,26,29,30,31,32,33,34,35,38,39,40,41,42,43,44,47,48,49,50,51,52,53,56,57,58,59,60,61,62,65,66,67,68,69,70,71,74,75,76,77,78,79,80'),
(14, 'Sol pourpre', 'ZoneMap_13.gif', 484, 48, 10, 470, 47, 10, ',11,12,13,14,15,16,17,20,21,22,23,24,25,26,29,30,31,32,33,34,35,38,39,40,41,42,43,44,47,48,49,50,51,52,53,56,57,58,59,60,61,62,65,66,67,68,69,70,71,74,75,76,77,78,79,80'),
(15, 'Barque dans la brume', 'ZoneMap_14.gif', 484, 48, 10, 470, 47, 10, ',11,12,13,14,15,16,17,20,21,22,23,24,25,26,29,30,31,32,33,34,35,38,39,40,41,42,43,44,47,48,49,50,51,52,53,56,57,58,59,60,61,62,65,66,67,68,69,70,71,74,75,76,77,78,79,80'),
(16, 'Neige', 'ZoneMap_15.gif', 484, 48, 10, 470, 47, 10, ',11,12,13,14,15,16,17,20,21,22,23,24,25,26,29,30,31,32,33,34,35,38,39,40,41,42,43,44,47,48,49,50,51,52,53,56,57,58,59,60,61,62,65,66,67,68,69,70,71,74,75,76,77,78,79,80'),
(17, 'Sol violet', 'ZoneMap_16.gif', 484, 48, 10, 470, 47, 10, ',11,12,13,14,15,16,17,20,21,22,23,24,25,26,29,30,31,32,33,34,35,38,39,40,41,42,43,44,47,48,49,50,51,52,53,56,57,58,59,60,61,62,65,66,67,68,69,70,71,74,75,76,77,78,79,80'),
(18, 'Tourbillon', 'ZoneMap_17.gif', 484, 48, 10, 470, 47, 10, ',11,12,13,14,15,16,17,20,21,22,23,24,25,26,29,30,31,32,33,34,35,38,39,40,41,42,43,44,47,48,49,50,51,52,53,56,57,58,59,60,61,62,65,66,67,68,69,70,71,74,75,76,77,78,79,80'),
(19, 'Foret de cote', 'ZoneMap_18.gif', 484, 48, 10, 470, 47, 10, ',11,12,13,14,15,16,17,20,21,22,23,24,25,26,29,30,31,32,33,34,35,38,39,40,41,42,43,44,47,48,49,50,51,52,53,56,57,58,59,60,61,62,65,66,67,68,69,70,71,74,75,76,77,78,79,80');

INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_zone_townmap_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_zone_townmap_name', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_zone_picture_link', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_zone_worldmap_zone', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Adr_zone_townmap_display_required', '1');

INSERT INTO phpbb_adr_shops_items (item_id, item_owner_id, item_price, item_quality, item_power, item_duration, item_duration_max, item_icon, item_name, item_desc, item_type_use, item_in_shop, item_mp_use, item_element, item_element_str_dmg, item_element_same_dmg, item_element_weak_dmg, item_store_id, item_weight, item_auth, item_max_skill, item_add_power, item_monster_thief, item_in_warehouse, item_sell_back_percentage, item_zone, item_zone_name) VALUES (6765, 1, 5000, 3, 1, 2, 3, 'scroll5.gif', 'Adr_items_scroll_5', 'Adr_items_scroll_5_desc', 4, 0, 0, 0, 0, 0, 0, 8, 1, 0, 0, 0, 0, 0, 75, 0, '');

# ADR - Spell advanced - upgrade
INSERT INTO `phpbb_adr_general` VALUES ('spell_enable_pm', '1');

# ADR - Day & Night
INSERT INTO phpbb_config (config_name, config_value) VALUES ('adr_time', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('adr_length_time', '10800');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('adr_time_last_time', '0');

# ADR - Weapon Proficiency
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (40, 2000, 'Adr_items_type_staff');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (41, 2000, 'Adr_items_type_dirk');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (42, 2000, 'Adr_items_type_mace');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (43, 2000, 'Adr_items_type_ranged');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (44, 2000, 'Adr_items_type_fist');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (45, 2000, 'Adr_items_type_axe');
INSERT INTO phpbb_adr_shops_items_type (item_type_id, item_type_base_price, item_type_lang) VALUES (46, 2000, 'Adr_items_type_spear');

# ADR - Shield prof
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('weapon_prof', 100);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('shield_bonus', 10);

# ADR - Togglable World Map
INSERT INTO phpbb_config (config_name, config_value) VALUES ('adr_world_map', 0);

# Rabbitoshi - levelup penalty
INSERT INTO `phpbb_rabbitoshi_general` VALUES ('next_level_penalty', 10);

# ADR - Guild mod (Renlok)
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_guild_overall_allow', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_guild_create_allow', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_guild_join_allow', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_guild_create_min_posts', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_guild_create_min_level', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('Adr_guild_create_min_money', 0);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_guild_exp_min', 1);
INSERT INTO phpbb_adr_general (config_name, config_value) VALUES ('battle_guild_exp_max', 100);



COMMIT;

