CREATE TABLE api_access (id BIGINT AUTO_INCREMENT, api_key VARCHAR(255) NOT NULL, api_secret VARCHAR(255) NOT NULL, user_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX api_key_unique_idx (api_key), INDEX user_id_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE category (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL UNIQUE, description LONGTEXT, slug VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX sluggable_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE document_index (keyword VARCHAR(200), field VARCHAR(50), position BIGINT, id BIGINT, PRIMARY KEY(keyword, field, position, id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE document (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL UNIQUE, description LONGTEXT, file VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, size VARCHAR(255) NOT NULL, public TINYINT(1), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), UNIQUE INDEX sluggable_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE document_category (id BIGINT AUTO_INCREMENT, document_id BIGINT NOT NULL, category_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX document_category_unique_idx (document_id, category_id), INDEX document_id_idx (document_id), INDEX category_id_idx (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE document_tag (id BIGINT AUTO_INCREMENT, document_id BIGINT NOT NULL, tag_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX document_tag_unique_idx (document_id, tag_id), INDEX tag_id_idx (tag_id), INDEX document_id_idx (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE document_version (id BIGINT AUTO_INCREMENT, document_id BIGINT NOT NULL, file VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX document_id_idx (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE tag (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL UNIQUE, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), UNIQUE INDEX sluggable_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE user (id BIGINT AUTO_INCREMENT, username VARCHAR(255) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, admin TINYINT(1), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), UNIQUE INDEX sluggable_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE user_category (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, category_id BIGINT NOT NULL, subscribe TINYINT(1), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX user_category_unique_idx (user_id, category_id), INDEX user_id_idx (user_id), INDEX category_id_idx (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE user_document (id BIGINT AUTO_INCREMENT, document_id BIGINT NOT NULL, user_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX user_document_unique_idx (user_id, document_id), INDEX document_id_idx (document_id), INDEX user_id_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
ALTER TABLE api_access ADD CONSTRAINT api_access_user_id_user_id FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE document_index ADD CONSTRAINT document_index_id_document_id FOREIGN KEY (id) REFERENCES document(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE document_category ADD CONSTRAINT document_category_document_id_document_id FOREIGN KEY (document_id) REFERENCES document(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE document_category ADD CONSTRAINT document_category_category_id_category_id FOREIGN KEY (category_id) REFERENCES category(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE document_tag ADD CONSTRAINT document_tag_tag_id_tag_id FOREIGN KEY (tag_id) REFERENCES tag(id);
ALTER TABLE document_tag ADD CONSTRAINT document_tag_document_id_document_id FOREIGN KEY (document_id) REFERENCES document(id);
ALTER TABLE document_version ADD CONSTRAINT document_version_document_id_document_id FOREIGN KEY (document_id) REFERENCES document(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE user_category ADD CONSTRAINT user_category_user_id_user_id FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE user_category ADD CONSTRAINT user_category_category_id_category_id FOREIGN KEY (category_id) REFERENCES category(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE user_document ADD CONSTRAINT user_document_user_id_user_id FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE user_document ADD CONSTRAINT user_document_document_id_document_id FOREIGN KEY (document_id) REFERENCES document(id) ON UPDATE CASCADE ON DELETE CASCADE;
